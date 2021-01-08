<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">

                            <h4 class="modal-title" ><b>Withdrawl Fd</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
        <form  method="POST" action="{{ url('withdrwalfixupdate/'.$services->fd_certificate_no) }}"enctype="multipart/form-data">
            <div class="modal-body info-modal-form">
              <input type="hidden" id="fkid" name="fk_fix_deposit_id" value="{{$fkid}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                                                <label for="exampleInputEmail1">Fix Deposit Certificate No</label>
                                                <input type="text" class="form-control" id="fixdepoistcertificate" name="fd_certificate_no" placeholder=""  value="{{$services->fd_certificate_no}}"readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Fix Deposit Amount</label>
                                                <input type="text" class="form-control"  id="fixdepositamount" name="fd_amount" placeholder="" value="{{$services->fd_amount}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Fix Deposit Percentage</label>
                                                <input type="text" class="form-control" id="fixdepoistpercentage" name="fd_percentage" placeholder="" value="{{$services->fd_percentage}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Fix Deposit Maturity Date</label>
                                                <input type="text" class="form-control" id="fixdepoistmaturitydate" name="fd_maturity_date" placeholder="" value="{{$services->fd_maturity_date}}"readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Fix Deposit Maturity Amount</label>
                                                <input type="text" class="form-control" id="fixdepositmaturityamount" name="fd_maturity_amount" placeholder="" value="{{$services->fd_maturity_amount}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">FD withdrawal date</label>
                                                <input type="text" class="form-control" id="withdrawaldate" name="withdrawaldate" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">FD withdrwal amount</label>
                                                <input type="text" class="form-control" id="amount" name="amount" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Naration</label>
                                                <textarea class="form-control" id="narration_main" name="narration_main" placeholder="ENTER NARRATION" value="{{ old('narration_main') }}" maxlength="150"></textarea>
                                            </div>
                                        </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
<script>$('#withdrawaldate').mask('00-00-0000');</script>
{{--<div class="modal fade" id="edit-modal">--}}
{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}

{{--                <h4 class="modal-title" ><b>Withdrawl Fd</b></h4>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <form role="form" action="/edit_user">--}}
{{--                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">--}}
{{--                    <div class="box-body">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">Fix Deposit Certificate No</label>--}}
{{--                            <input type="text" class="form-control" id="fixdepoistcertificate" name="fixdepoistcertificate" placeholder="" readonly>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">Fix Deposit Amount</label>--}}
{{--                            <input type="text" class="form-control"  id="fixdepositamount" name="fixdepositamount" placeholder="" readonly>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">Fix Deposit Percentage</label>--}}
{{--                            <input type="text" class="form-control" id="fixdepoistpercentage" name="fixdepoistpercentage" placeholder=""  readonly>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">Fix Deposit Maturity Date</label>--}}
{{--                            <input type="text" class="form-control" id="fixdepoistmaturitydate" name="fixdepoistmaturitydate" placeholder="" readonly>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">Fix Deposit Maturity Amount</label>--}}
{{--                            <input type="text" class="form-control" id="fixdepositmaturityamount" name="fixdepositmaturityamount" placeholder="" readonly>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">FD withdrawal date</label>--}}
{{--                            <input type="text" class="form-control" id="withdrawaldate" name="withdrawaldate" placeholder="">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">FD withdrwal amount</label>--}}
{{--                            <input type="text" class="form-control" id="amount" name="amount" placeholder="">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">Naration</label>--}}
{{--                            <textarea class="form-control" id="narration_main" name="narration_main" placeholder="ENTER NARRATION" value="{{ old('narration_main') }}" maxlength="150"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="submit" class="btn btn-primary">Save changes</button>--}}
{{--                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>--}}

{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
