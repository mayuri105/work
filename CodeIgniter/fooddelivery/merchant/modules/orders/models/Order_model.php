<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'orders';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'o_id';

    public function record_count() {
       
         $order_id = $this->input->get('order_id');
        $customer = $this->input->get('customer');
        $cv_status = $this->input->get('cv_status');
        $payment_method = $this->input->get('payment_type');
        $totalamt = $this->input->get('totalamt');
        $date_added = $this->input->get('date_added');
        
        
        if($order_id){
            $this->db->where('orders.o_id',$order_id);
            
        }
        if($customer){
            $this->db->like('customer.first_name',$customer);
            $this->db->or_like('customer.last_name',$customer);
        }

        if($cv_status){
            $this->db->like('order_status.name',$cv_status);
           
        }
        if($payment_method){
            $this->db->like('orders.payment_method',$payment_method);
           
        }
        if($totalamt){
            $this->db->where('total_amt',$totalamt);
        }
        if($date_added){
            $this->db->like('orders.created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        


        $this->db->join('order_store', 'order_store.o_id = orders.o_id');
        $this->db->join('customer', 'customer.c_id = orders.customer_id');
        $this->db->join('order_status', 'order_status.order_status_id = order_store.order_status_id');
        $this->db->join('store', 'store.store_id = order_store.store_id');
        
        $this->db->order_by('orders.o_id','desc');
        $this->db->group_by('orders.o_id');
        $mid = $this->session->userdata('m_id');
        $this->db->where('merchant_id',$mid);
       
        $ret = $this->db->get(self::TABLE_NAME)->result();
        return count($ret);
    }

    public function fetch_data($limit, $start){
        $order_id = $this->input->get('order_id');
        $customer = $this->input->get('customer');
        $cv_status = $this->input->get('cv_status');
        $payment_method = $this->input->get('payment_type');
        $totalamt = $this->input->get('totalamt');
        $date_added = $this->input->get('date_added');
        
        
        if($order_id){
            $this->db->where('orders.o_id',$order_id);
            
        }
        if($customer){
            $this->db->like('customer.first_name',$customer);
            $this->db->or_like('customer.last_name',$customer);
        }

        if($cv_status){
            $this->db->like('order_status.name',$cv_status);
           
        }
        if($payment_method){
            $this->db->like('orders.payment_method',$payment_method);
           
        }
        if($totalamt){
            $this->db->where('total_amt',$totalamt);
        }
        if($date_added){
            $this->db->like('orders.created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        


        $this->db->join('order_store', 'order_store.o_id = orders.o_id');
        $this->db->join('customer', 'customer.c_id = orders.customer_id');
        $this->db->join('order_status', 'order_status.order_status_id = order_store.order_status_id');
        $this->db->join('store', 'store.store_id = order_store.store_id');
        
        $this->db->limit($limit, $start);
        
        $this->db->order_by('orders.o_id','desc');
        $this->db->group_by('orders.o_id');
        $mid = $this->session->userdata('m_id');
        $this->db->where('merchant_id',$mid);
        $query = $this->db->get('orders');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                 $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
    
    function getorder($id){
        $query = new stdClass();
        $this->db->where('o_id',$id);
        $this->db->join('customer', 'customer.c_id = orders.customer_id','left');
        $this->db->join('address', 'address.customer_id = customer.c_id', 'left');
        $this->db->join('order_status', 'order_status.order_status_id = orders.order_status','left');
        $this->db->join('wallet_history', 'wallet_history.order_id = orders.o_id', 'left');
        
        $this->db->order_by(self::PRI_INDEX,'desc');
        $query->order = $this->db->get(self::TABLE_NAME)->row();
        $this->db->where('order_id',$id);
        $query->order_coupon = $this->db->get('coupons_histroy')->row();

        $this->db->where('o_id',$id);
        $mid = $this->session->userdata('m_id');
        $this->db->where('merchant_id',$mid);
        $this->db->join('store', 'store.store_id = order_store.store_id');

        $query->order_store = $this->db->get('order_store')->result();
        return $query;
    }
    function getOrderItemByStore($id){

        $this->db->group_by('order_item.oi_id');        
        $this->db->where('order_item.s_id',$id);
        $this->db->join('order_item_option', 'order_item_option.order_item_id = order_item.oi_id', 'left');
        $query  = $this->db->get('order_item')->result();
        return $query;

    }
    function getOptionval($id){
        $this->db->where('order_item_id',$id);
        $query = $this->db->get('order_item_option')->result();
        return $query;
    }

    public function insert(Array $data) {
        if ($this->db->insert(self::TABLE_NAME, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function insertsubOrder(Array $data) {
        if ($this->db->insert('order_store', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    public function insert_orderitem(Array $data) {
        if ($this->db->insert('order_item', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function insert_orderitemOp(Array $data) {
        if ($this->db->insert('order_item_option', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
    }

     public function updateStoreOrder(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('so_id' => $where);
            }
        $this->db->update('order_store', $data, $where);
        return $this->db->affected_rows();
    }
    
    public function updateCust(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('c_id'=> $where);
            }
        $this->db->update('customer', $data, $where);
        return $this->db->affected_rows();
    }
    public function updateAddress(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('address_id'=> $where);
            }
        $this->db->update('address', $data, $where);
        return $this->db->affected_rows();
    }
    public function delete($id) {
       
        $where = array(self::PRI_INDEX => $id);
        $this->db->delete(self::TABLE_NAME, $where);
         $ret = $this->db->affected_rows();

        $this->db->where('o_id', $where);
        $this->db->delete('order_item');
        return $ret;
    }

    public function fetch_products(){

        $query = $this->db->get('products');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }
    public function fetch_stores(){

        $query = $this->db->get('store');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }
    public function get_product_by_cat($id){

        $this->db->select('products.*,product_to_category.category_id');
        $this->db->join('product_to_category','product_to_category.product_id = products.product_id'); 
        $this->db->where('product_to_category.category_id', $id);
        $query = $this->db->get('products')->result();
        return $query;

    }
    function get_product_by_id($id){

        $this->db->where('product_id', $id);
        $query = $this->db->get('products')->result();
        return $query;
    }
    public function fetch_customer(){
        $this->db->select('c_id,first_name,last_name');
        $query = $this->db->get('customer');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function getorder_status(){
        $query = $this->db->get('order_status')->result();
        return $query;
    }
    public function delete_item($id){
        $this->db->where('oi_id', $id);
        $this->db->delete('order_item');
        return $this->db->affected_rows();
    }
    public function getstatus(){
        return $this->db->get('order_status')->result();
    }

    public function insert_orderHistroy(Array $data) {
        if ($this->db->insert('order_histroy', $data)) {
            return $this->db->insert_id();
        }else{
           return false;
        }
    }
    public function productSearch(){
        $this->db->select('product_id,product_name', FALSE);
        $this->db->like('product_name',post('search'));
        $query =  $this->db->get('products')->result_array();

        return $query;
    }

    public function getProductOption(){
        $query = new stdClass();
        $this->db->select('product_option.*,product_option_value.*', FALSE);
        $this->db->order_by('product_option.option_id', 'asc');
        $this->db->group_by('product_option.option_id');
        $this->db->where('product_id',post('product_id'));
        $this->db->join('product_option_value', 'product_option_value.option_group_id = product_option.option_id');
        $query->product_option =  $this->db->get('product_option')->result();
        $this->db->where('product_id',post('product_id'));
        $query->products =  $this->db->get('products')->row();
        return $query;
    }
    public function getoption($id){
        $this->db->where('option_group_id',$id);
        $query =  $this->db->get('product_option_value')->result();
        if ($query) {
            return $query;
        }else{
            return 0;
        }
    }

    public function getOptionData($id){
        $this->db->where('po_id',$id);
        $this->db->join('product_option', 'product_option.option_id = product_option_value.option_group_id', 'left');
        $query =  $this->db->get('product_option_value')->row();
        if ($query) {
            return $query;
        }else{
            return 0;
        }
    }
    public function getPrductbyId($id){
        $this->db->where('product_id',$id);
        $this->db->join('store', 'store.store_id = products.store_id', 'left');
        $query= $this->db->get('products')->row();
        return $query;
        
    }

    public function insertOrderItem(Array $data){
        if ($this->db->insert('order_item', $data)) {
            return $this->db->insert_id();
        }else{
           return false;
        }

    }
    public function insertOrderItemVal(Array $data){
        if ($this->db->insert('order_item_option', $data)) {
            return $this->db->insert_id();
        }else{
           return false;
        }
    }
   
    public function deleteItem($id) {
        if (!is_array()) {
            $where = array('oi_id' => $where);
        }
        $this->db->where('oi_id', $id);
        $this->db->delete('order_item');
        $ret = $this->db->affected_rows();

        $this->db->where('order_item_id', $id);
        $this->db->delete('order_item_option');
        return $ret;
    }

    
    public function getminOrder($store_id){
        $this->db->where('store_id', $store_id, FALSE);
        $this->db->join('store_del_info', 'store_del_info.s_id = store.store_id','left');
        $query = $this->db->get('store')->row(); 
        return $query->minorder;
    }
    public function DiscountOnPrdoduct($product_id){
         $this->db->select('products.*,products.start_time as pst,
            products.end_time as pet,
            products.discount as pdiscount,
            category.start_time as cst,
            category.end_time as cet,
            category.discount as cdiscount', FALSE);
        $this->db->join('product_to_category', 'product_to_category.product_id = products.product_id','left');
        $this->db->join('category', 'category.cat_id = product_to_category.category_id', 'left');
        $this->db->where('products.product_id', $product_id);
        $result = $this->db->get('products')->row();
        $today = date('Y-m-d');
        $product_discount = 0;
        $category_discount= 0;
        if ($result->pst <= $today && $result->pet >= $today) {
              $product_discount =$result->pdiscount;
        }
        if ($result->cst <= $today && $result->cet >= $today) {
             $category_discount=$result->cdiscount;
        }
        $discount = max($category_discount,$product_discount);
        $returnPrice = ($result->price * $discount )/100;
        return  $result->price - $returnPrice;
    }

    function getMaxInvoiceno(){
        $this->db->select('max(invoice_no) as maxinv,invoice_prefix');
        $ret = $this->db->get('orders');
        return $ret->row();    
    }

    public function getSubOrderHistory($id){
        
        $this->db->where('order_id',$id);
        $this->db->join('order_store', 'order_store.so_id = order_histroy.sub_order_id', 'left');
        $this->db->join('order_status', 'order_status.order_status_id = order_histroy.order_status', 'left');
        $query= $this->db->get('order_histroy')->result();
        return $query;
    }

    public function getStoreByorder($id){
        $m_id =  $this->session->userdata('m_id');
        $this->db->where('o_id',$id);
        $order= $this->db->get('orders')->row();
        $this->db->where('zipcode', $order->shipping_zip);

        $this->db->where('merchant_id',$m_id);
        $this->db->join('store_delivery_zip', 'store_delivery_zip.zip_code_id = city_zipcode.cz_id', 'left');
        $this->db->join('store', 'store.store_id = store_delivery_zip.store_id', 'left');

        $ret = $this->db->get('city_zipcode');
        return $ret->result();
    }

    public function getProduct(){
        $this->db->select('product_id,product_name');
        $this->db->where('store_id',post('store_id'));
        $query =  $this->db->get('products')->result_array();
        return $query;
    }
    public function getsuborderId($order_id,$store_id){
        $this->db->where('o_id',$order_id);
        $this->db->where('store_id',$store_id);
        $query =  $this->db->get('order_store')->row();
        return $query->so_id;
    }

    public function getMainOrder($order_id){
        $od = $order_id;
        $this->db->where('o_id',$od);
        $query =  $this->db->get('orders');
        return $query->row();
    }

    public function updateSuborder(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('so_id'=> $where);
            }
        $this->db->update('order_store', $data, $where);
        return $this->db->affected_rows();
    }
    public function suborderTotalamt($subOrder_id){
        $this->db->group_by('order_item.oi_id');        
        $this->db->where('order_item.s_id',$subOrder_id);
        $this->db->join('order_item_option', 'order_item_option.order_item_id = order_item.oi_id', 'left');
        $order_item = $this->db->get('order_item')->result();

        if ($order_item) {
            $total=0; 
            foreach ($order_item as $item){
                $this->db->where('order_item_id',$item->oi_id);
                $getOptionValue = $this->db->get('order_item_option')->result();

                    $tot=0;
                    foreach($getOptionValue as $option){
                        $tot += $option->price; 
                    }
                    $totalUnitPrice = $tot + $item->product_price; 
                    $price = $item->pro_quantity * $totalUnitPrice;
                    $total += $price; 
            }
            $dataUpdate = array(
                'total' => $total
            );
            $where = array('so_id'=>$subOrder_id);
            $this->db->update('order_store', $dataUpdate, $where);
            return $this->db->affected_rows();
        }else{
            $this->db->where('so_id', $subOrder_id);
            $ret= $this->db->delete('order_store');
            return $ret;
        }
    }

    public function getCustmerAddress(){
        $id = post('id');
        $this->db->where('customer_id',$id);
        $query =  $this->db->get('address');
        return $query->result();

    }

    public function getAddressDet(){
        $id = post('id');
        $this->db->where('address_id',$id);
        $query =  $this->db->get('address');
        return $query->row();
    }

    public function getStoreByzip($zipcode){
        
        $this->db->where('zipcode',$zipcode);
        $this->db->join('store_delivery_zip', 'store_delivery_zip.zip_code_id = city_zipcode.cz_id', 'left');
        $this->db->join('store', 'store.store_id = store_delivery_zip.store_id', 'left');
        $ret = $this->db->get('city_zipcode');
        return $ret->result();
    }

    public function getmerchant_wise_orders(){
        if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->where('merchant_id',$mid);
        }
        $this->db->select('store_id');
        $query = $this->db->get('store');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $this->db->where('store_id',$row->store_id);
                $order_store = $this->db->get('order_store');
                if ($order_store->num_rows() > 0) {
                    foreach ($order_store->result() as $row) {
                        $data[] = $row->o_id;
                    }
                }

            }
            return $data;
        }
        return false;
    }      
    public function getCustInfo($order_id){
        $this->db->where('o_id', $order_id);
        $this->db->join('customer', 'customer.c_id = orders.customer_id', 'left');
        $order = $this->db->get('orders')->row();
        return $order;
    }

    public function getOrderStatus($order_status_id){
        $this->db->where('order_status_id', $order_status_id);
        $order_status = $this->db->get('order_status')->row();
        return $order_status->name;
    }

    public function getStoreName($sub_order_id){
        $this->db->where('so_id', $sub_order_id);
        $store = $this->db->get('order_store')->row();
        return $store->store_name;

    }
    public function getLastStatusId($order_id,$sub_order_id){
        $this->db->order_by('oh_id', 'DESC');
        $this->db->where('sub_order_id', $sub_order_id);
        $this->db->where('order_id', $order_id);
        $order_histroy = $this->db->get('order_histroy')->row();
        return $order_histroy->order_status;
    }

    public function getRecentOrder(){
        $this->db->select('order_store.store_name,orders.o_id', FALSE);
        $this->db->join('order_store', 'order_store.o_id = orders.o_id', 'left');
        $this->db->join('order_status', 'order_status.order_status_id = order_store.order_status_id');
        $this->db->join('store', 'store.store_id = order_store.store_id');
        $this->db->order_by('orders.o_id','desc');
        $mid = $this->session->userdata('m_id');
        $this->db->group_start();
        $this->db->where('read_by_merchant','0');
        $this->db->or_where('read_by_merchant IS NULL', null);
        $this->db->group_end();
        $this->db->where('merchant_id',$mid);
        $query = $this->db->get('orders');
        return  $query->result();
    }

    public function updateRecentOrder(){
        $this->db->select('order_store.store_name,orders.o_id', FALSE);
        $this->db->join('order_store', 'order_store.o_id = orders.o_id', 'left');
        $this->db->join('order_status', 'order_status.order_status_id = order_store.order_status_id');
        $this->db->join('store', 'store.store_id = order_store.store_id');
        $this->db->order_by('orders.o_id','desc');
        $mid = $this->session->userdata('m_id');
        $this->db->group_start();
        $this->db->where('read_by_merchant','0');
        $this->db->or_where('read_by_merchant IS NULL', null);
        $this->db->group_end();
        $this->db->where('store.merchant_id',$mid);
         $this->db->where('merchant_id',$mid);
        $query = $this->db->get('orders');
        
        foreach ($query->result() as $a) {
              $dataUpdate = array(
                'read_by_merchant' =>'1'
            );
            $where = array('o_id',$a->o_id);
            $this->db->update('orders', $dataUpdate,$where);
        }
        
        return $this->db->affected_rows();
    }


}
