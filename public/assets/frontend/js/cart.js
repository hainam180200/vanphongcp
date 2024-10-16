$( document ).ready(function() {
   const csrf_token = $('meta[name="csrf-token"]').attr('content');
   $('body').on('click','#add-cart',function(e){
      e.preventDefault()
      var formData = $('#formDetails').serialize();
      var id = $('#id_prd').val();
      $.ajax({
         type: "POST",
         url: '/cart/add/'+id,
         data: formData,
         beforeSend: function (xhr) {
            $('#add-cart').html('<i class="fas fa-sync-alt"></i>');
            $(this).prop('disabled', true);
         },
         success: function (data) {
            $('#add-cart').html('<i class="fas fa-cart-plus"></i>');
            if(data.status == 1){
               $('#cart-total b').html(data.total_cart);
               toastr.success(data.message);
            }
            else{
               toastr.error(data.message);
            }
         },
         error: function (data) {   
            toastr.error('Có lỗi phát sinh, vui lòng thử lại.');
            $('#add-cart').html('<i class="fas fa-cart-plus"></i>');
         },
         complete: function (data) {
            $(this).prop('disabled', false);
         }
      });
   })
   $('body').on('click','button.cartMinutes',function(){
      var rowId = $(this).data('rowid');
      var type = "minutes";
      updateCart(rowId,type);
   })
   $('body').on('click','button.cartPlus',function(){
      var rowId = $(this).data('rowid');
      var type = "plus";
      updateCart(rowId,type);
   })
   function updateCart(rowId,type){
      $.ajax({
         type: "POST",
         url: '/cart/update/'+rowId,
         data: {
            _token:csrf_token,
            type:type
         },
         beforeSend: function (xhr) {
            
         },
         success: function (data) {
            if(data.status == 1){
               if(data.redirect === true){
                  window.location.reload();
                  return;
               }
               $('#cart-total b').html(data.count);
               if(data.delete === true){
                  $('.cart-item-el-'+rowId).remove();
               }
               $('.cart-item-val-'+rowId).val(data.qtyItemCart);
               $('strong#price').text(data.total+' ₫')
               $('strong#price_base').text((data.total_base)+ ' ₫')
               $('strong#sum_price').text(data.total+ ' ₫')
               $('#content_price').text(data.total_content+ '  đồng.')
            }
            else{
               toastr.error(data.message);
            }
         },
         error: function (data) {   
            toastr.error('Có lỗi phát sinh, vui lòng thử lại.');
         },
         complete: function (data) {
           
         }
      });
   }
   $('body').on('click','.btn-delete-item-cart',function(){
      var rowId = $(this).data('rowid');
      $.ajax({
         type: "POST",
         url: '/cart/delete/'+rowId,
         data: {
            _token:csrf_token,
         },
         beforeSend: function (xhr) {
            
         },
         success: function (data) {
            if(data.status == 1){
               if(data.redirect === true){
                  window.location.reload();
                  return;
               }
               $('#cart-total b').html(data.count);
               if(data.delete === true){
                  $('.cart-item-el-'+rowId).remove();
               }
               $('strong#price').text(data.total+' ₫')
               $('strong#price_base').text((data.total_base)+ ' ₫')
               $('strong#sum_price').text(data.total+ ' ₫')
               $('#content_price').text(data.total_content+ '  đồng.')
            }
            else{
               toastr.error(data.message);
            }
         },
         error: function (data) {   
            toastr.error('Có lỗi phát sinh, vui lòng thử lại.');
         },
         complete: function (data) {
           
         }
      });
   });

   $('body').on('change','#provinces',function(){
      var provinces = $(this).val();
      $.ajax({
         type: "GET",
         url: '/get-districts',
         data: {
            code:provinces,
         },
         beforeSend: function (xhr) {
            $('#districts').html('<option value="">Quận/Huyện *</option>')
         },
         success: function (data) {
            if(data.status == 1){
               let html = '';
               $.each(data.data,function(key,value){
                  html += '<option value='+value.code+'>'+value.name+'</option>'
               })
               $('#districts').append(html)
            }
            else{
               toastr.error(data.message);
            }
         },
         error: function (data) {   
            toastr.error('Có lỗi phát sinh, vui lòng thử lại.');
         },
         complete: function (data) {
           
         }
      });
   })
   $('#formBuyNow').submit(function(e){
      e.preventDefault();
      var formSubmit = $(this);
      var url = formSubmit.attr('action');
      var btnSubmit = formSubmit.find(':submit');
      btnSubmit.text('ĐANG XỬ LÝ...');
      btnSubmit.prop('disabled', true);
      $.ajax({
          type: "POST",
          url: url,
          cache:false,
          data: formSubmit.serialize(), // serializes the form's elements.
          beforeSend: function (xhr) {
          
          },
          success: function (data) {
             if(data.status == 1){
                btnSubmit.text('THÀNH CÔNG');
                toastr.success(data.message);
                if(data.redirect == true){
                   location.href = data.url
                }
             }
             else{
               toastr.error(data.message);
               btnSubmit.text('TIẾN HÀNH ĐẶT HÀNG');
             }
          },
          error: function (data) {
               toastr.error('Có lỗi phát sinh, vui lòng thử lại.');
              btnSubmit.text('TIẾN HÀNH ĐẶT HÀNG');
          },
          complete: function (data) {
          
              btnSubmit.prop('disabled', false);
          }
      })
  })
   $('#installmentForm').submit(function(e){
      e.preventDefault();
      var formSubmit = $(this);
      var url = formSubmit.attr('action');
      var btnSubmit = formSubmit.find(':submit');
      btnSubmit.text('ĐANG XỬ LÝ...');
      btnSubmit.prop('disabled', true);
      $.ajax({
          type: "POST",
          url: url,
          cache:false,
          data: formSubmit.serialize(), // serializes the form's elements.
          beforeSend: function (xhr) {
          
          },
          success: function (data) {
             if(data.status == 1){
                btnSubmit.text('THÀNH CÔNG');
                toastr.success(data.message);
                btnSubmit.text('GỬI YÊU CẦU THÀNH CÔNG');
                formSubmit.reset();
             }
             else{
               toastr.error(data.message);
               btnSubmit.text('GỬI YÊU CẦU');
               btnSubmit.prop('disabled', false);
             }
          },
          error: function (data) {
               toastr.error('Có lỗi phát sinh, vui lòng thử lại.');
               btnSubmit.text('GỬI YÊU CẦU');
               btnSubmit.prop('disabled', false);
          },
          complete: function (data) {
          
              
          }
      })
  })
});