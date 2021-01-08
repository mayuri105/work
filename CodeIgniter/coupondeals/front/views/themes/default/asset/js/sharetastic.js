// --------------------------------------------------------------------------
//      _                    _            _   _      
//     | |                  | |          | | (_)     
//  ___| |__   __ _ _ __ ___| |_ __ _ ___| |_ _  ___ 
// / __| '_ \ / _` | '__/ _ \ __/ _` / __| __| |/ __|
// \__ \ | | | (_| | | |  __/ || (_| \__ \ |_| | (__ 
// |___/_| |_|\__,_|_|  \___|\__\__,_|___/\__|_|\___|
//
// --------------------------------------------------------------------------
//  Version: 1.2.4
//   Author: Simon Sturgess
//  Website: dahliacreative.github.io/sharetastic
//     Docs: dahliacreative.github.io/sharetastic/docs
//     Repo: github.com/dahliacreative/sharetastic
//   Issues: github.com/dahliacreative/sharetastic/issues
// --------------------------------------------------------------------------

(function(window, $) {

  $.fn.sharetastic = function(options) {
    var spriteOption = options && options.hasOwnProperty('sprite'),
        sprite = spriteOption ? options.sprite : 'sharetastic.svg';

    $.ajax({
      url: sprite,
      success: function(data) {
        $('body').prepend(data.documentElement);
      }
    });

    return this.each(function() {
      new Sharetastic($(this), options).build();
    });
  };

})(window, jQuery);

// --------------------------------------------------------------------------
// Sharetastic Constructor
// --------------------------------------------------------------------------
 var Sharetastic = function(el, options) {

  // Get page Details
  this.page = {
    url: window.location,
    title: $('#title').text(),
    //description: this.getMetaContent('description'),
	img:document.getElementById("myImg").src
  }

  // Initialise the element
  this.el = el;
  this.el.addClass('sharetastic');
  
  // Extend Options
  this.options = $.extend(true, {
    sprite: 'sharetastic.svg',
    popup: true,
    services: {
      facebook: {
        enabled: true,
        href: 'https://www.facebook.com/sharer/sharer.php?u=' + this.page.url + '&picture=' + this.page.img   + '&title=' + this.page.title ,
        icon: {
          width: 10,
          height: 19,
          id: 'sharetastic-facebook'
        }
      },
      instagram: {
        enabled: false,
        href: 'https://www.instagram.com/',
        icon: {
          width: 20,
          height: 20,
          id: 'sharetastic-instagram'
        }
      },
      twitter: {
        enabled: true,
        href: 'http://twitter.com/home?status=' + this.page.title + ' - ' + this.page.description + ' - ' + this.page.url,
        icon: {
          width: 18,
          height: 14,
          id: 'sharetastic-twitter'
        }
      },
      pinterest: {
        enabled: true,
        href: 'http://pinterest.com/pin/create/link/?url=' + this.page.url + '&description=' + this.page.title + ' - ' + this.page.description,
        icon: {
          width: 20,
          height: 25,
          id: 'sharetastic-pinterest'
        }
      },
      linkedin: {
        enabled: true,
        href: 'https://www.linkedin.com/shareArticle?mini=true&url=' + this.page.url + '&title=' + this.page.title + '&summary=' + this.page.description,
        icon: {
          width: 18,
          height: 18,
          id: 'sharetastic-linkedin'
        }
      },
      googleplus: {
        enabled: true,
        href: 'https://plus.google.com/share?url=' + this.page.url,
        icon: {
          width: 18,
          height: 18,
          id: 'sharetastic-googleplus'
        }
      },
      flickr: {
        enabled: false,
        href: 'https://www.flicr.com/',
        icon: {
          width: 19,
          height: 8,
          id: 'sharetastic-flickr'
        }
      },
      email: {
        enabled: true,
        href: 'https://gmail.com',// + this.page.title + '%0A' + this.page.description + '%0A' + this.page.url,
        icon: {
          width: 20,
          height: 13,
          id: 'sharetastic-email'
        }
      }
    }
  }, options);

};


// --------------------------------------------------------------------------
// Build the DOM
// --------------------------------------------------------------------------
Sharetastic.prototype.build = function() {
  for(var key in this.options.services) {
    if(this.options.services[key].enabled) {
      var link = $('<a/>'),
          service = this.options.services[key],
          self = this;
      link
        .addClass('sharetastic__button sharetastic__button--'+key)
        .attr('href', service.href)
        .attr('target', '_blank')
        .html('<svg width="' + service.icon.width + '" height="' + service.icon.height + '" class="sharetastic__icon"><use xlink:href="#' + service.icon.id + '"/></svg>');
      this.el.append(link);
      if(key !== 'email' && this.options.popup) {
        link.on('click', function() {
          console.log('pop')
          self.popup($(this).attr('href'), 500, 300);
          return false;
        });
      }
    }
  }
};



// --------------------------------------------------------------------------
// Get Meta Content
// --------------------------------------------------------------------------
Sharetastic.prototype.getMetaContent = function(propName) {
  var metas = document.getElementsByTagName('meta');
  for(var i = 0; i < metas.length; i++) {
    var name = metas[i].getAttribute("name");
    if(name == propName) {
      return metas[i].getAttribute("content");
    }
  }
  return "";
};


// --------------------------------------------------------------------------
// Pop up Window
// --------------------------------------------------------------------------
Sharetastic.prototype.popup = function(url, width, height) {
  var left = (screen.width / 2) - (width / 2),
      top = (screen.height / 2) - (height / 2);
  window.open(url, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left);
};
