
var FormControls= {
    init:function() {
        $("#entry_queue").validate( {
            rules: {
               document_no: {
                required: !0
            }
            , mover: {
                required: !0
            }
            , employee: {
                required: !0
            }
            }
            , invalidHandler:function(e, r) {
                mUtil.scrollTop()
            }
            , submitHandler:function(e) {
                // return swal( {
                //     title: "", text: "Form validation passed. All good!", type: "success", confirmButtonClass: "btn_entry_queue"
                // }
                // ), !1
                e.submit();
            }
        }
        ),

        $("#qc_request_form").validate( {
         rules: {
            document_no: {
                required: !0
            }
            , qc_by: {
                required: !0
            }
            , remark: {
                required: !0
            }
            ,entry_queue_id: {
                required: !0
            }

         }
            , invalidHandler:function(e, r) {
                mUtil.scrollTop()
            }
            , submitHandler:function(e) {
                e.submit();
            }
        }
        ),

        $("#qcrequest_srno").validate( {
         rules: {
            document_no: {
                required: !0
            }
            , product_number: {
                required: !0
            }
            , qty_qc: {
                required: !0
            }
            ,part_name: {
                required: !0
            }
            ,um: {
                required: !0
            }
            ,description: {
                required: !0
            }
            ,serial_no: {
                required: !0
            }

         }
            , invalidHandler:function(e, r) {
                mUtil.scrollTop()
            }
            , submitHandler:function(e) {
                e.submit();
            }
        }
        ),

        $("#qcreturn_srno").validate( {
         rules: {
            document_no: {
                required: !0
            }
            , product_number: {
                required: !0
            }
            , qty_qc: {
                required: !0
            }
            ,part_name: {
                required: !0
            }
            ,um: {
                required: !0
            }
            ,description: {
                required: !0
            }
            ,serial_no: {
                required: !0
            }

         }
            , invalidHandler:function(e, r) {
                mUtil.scrollTop()
            }
            , submitHandler:function(e) {
                e.submit();
            }
        }
        ),

        $("#document_form").validate( {
         rules: {
            document_no: {
                required: !0
            }
            , reference_type: {
                required: !0
            }
            , reference: {
                required: !0
            }
            , sender_phone: {
                required: !0
            }
            , source: {
                required: !0
            }
            , source_type:{
                 required: !0
            }
            , source_name: {
                required: !0
            }
            , remark: {
                required: !0
            }

         }
            , invalidHandler:function(e, r) {
                mUtil.scrollTop()
            }
            , submitHandler:function(e) {
                e.submit();
            }
        }
        )
  }
}
jQuery(document).ready(function() {
    FormControls.init()
});