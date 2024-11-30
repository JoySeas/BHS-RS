

<div id="mdllistofseller" class="modal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 800px;">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div style="display: flex;justify-content: space-between !important;">
                            <h4 class="headerfontfont2" style="color: #2c2b2e;font-weight: 500;">Select Seller</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearuseracc()" style="padding: 1rem 1rem;margin: -1.6rem -1rem -1rem auto;">×</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <table data-height="350" class="table table-bordered fixTable table-hover" style="margin-bottom: 0px;">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th style="width: 2%;white-space: nowrap;text-align: center;"> # </th>
                                        <th style="width: 7%;white-space: nowrap;"> Image </th>
                                        <th style="width: 25%;white-space: nowrap;"> Name </th>
                                        <th style="width: 7%;white-space: nowrap;"> Phone </th>
                                        <th style="width: 7%;white-space: nowrap;"> Email </th>
                                    </tr>
                                </thead>
                                <tbody id="tblpendingsellerlist"></tbody>
                            </table>
                        </div>

                        <input id="txtpendingsellerlistPageCount" type="hidden">
                        <ul id="uppendingsellerlistPageList" class="pagination float-right"></ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="mdlopencustprof" class="modal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 450px;">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div style="display: flex;justify-content: space-between !important;">
                            <h4 class="headerfontfont2" style="color: #2c2b2e;font-weight: 500;">Seller Information</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearuseracc()" style="padding: 1rem 1rem;margin: -1.6rem -1rem -1rem auto;">×</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h6>Full Name: <span style="color: #54667a;font-weight: 300;" id="txtfullname"></span></h6>
                        <h6>Contact Number: <span style="color: #54667a;font-weight: 300;" id="txtcontactnum"></span>
                        </h6>
                        <h6 class="mb-4">Email: <span style="color: #54667a;font-weight: 300;" id="txtemail"></span>
                        </h6>

                        <h6>Address: <span style="color: #54667a;font-weight: 300;" id="txtaddress"></span></h6>
                        <!-- <div class="mb-4" id="map-box"></div> -->

                        <input type="hidden" class="form-control" id="txtLat">
                        <input type="hidden" class="form-control" id="txtLong">
                        <div class="mb-4" id="map_canvas" style="height: 300px; width:100% !important; border-radius: 0px !important;"></div>

                        <h6>Valid ID</h6>
                        <img src="assets/images/noimage5.png" alt="user" class="img" width="120" style="border: 1px solid #e6e6e6; cursor:pointer;" id="imgvalidID" onclick="">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="mdlviewpaymentphoto" class="modal">
    <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 600px;">
        <div class="modal-content">
            <img src="assets/images/noimage5.png" class="img-thumbnail" id="viewpaymentimg">
        </div>
    </div>
</div>