
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// delete menu
function removeRow (element)
{  
    var id = $(element).data('id');
    var url = $(element).data('url');

    if(confirm('Bạn có chắc chắn không? Nếu bạn chọn XÓA thì phần tử này sẽ mất vĩnh viễn khỏi hệ thống'))
    {      
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: {id},//{id: id}
            url: url,
            success: function(result){             
                if(result && result.error === false){
                    alert(result.message);
                    location.reload();//load lại trang
                } else{
                    alert('Xóa không thành công. Vui lòng thử lại');
                }   
            },
        })
    }
}


//delete product
function removeRowProduct(element) {
    var id = $(element).data('id');
    var url = $(element).data('url');

    if (confirm('Bạn có chắc chắn không? Nếu bạn chọn XÓA thì sản phẩm này sẽ mất vĩnh viễn khỏi hệ thống')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                if (result && result.error === false) {
                    alert('Xóa sản phẩm thành công');
                    location.reload(); // Load lại trang
                } else {
                    alert('Xóa sản phẩm không thành công. Vui lòng thử lại');
                }
            },
        });
    }
}


//xử lý hình ảnh cũ <-> mới --> sửa //hiện tên ảnh
    function displayImage() {
        // Lấy element input file
        var fileInput = document.getElementById('upload');
        
        // Lấy element ảnh để hiển thị
        var productImage = document.getElementById('productImage');

        // Kiểm tra xem đã chọn file hay chưa
        if (fileInput.files.length > 0) {
            // Nếu có file được chọn, cập nhật src của ảnh để hiển thị ngay lập tức
            var newImage = URL.createObjectURL(fileInput.files[0]);
            productImage.src = newImage;

            // (Optional) Đặt giá trị của input file về null để có thể chọn cùng một tệp nếu người dùng muốn
            // fileInput.value = null;
        }
    }

// xử lý ảnh có thẻ để người người dùng xem ảnh trước khi upload (thêm) //hiện ảnh
    function displaySelectedImage() {
        const fileInput = document.getElementById('upload');
        const previewImage = document.getElementById('previewImage');

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const reader = new FileReader();
            
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '#';
            previewImage.style.display = 'none';
        }
    }
//xử lý ảnh có thẻ để người người dùng xem ảnh trước khi upload

//delete slider
function removeRowSlider(element) {
    var id = $(element).data('id');
    var url = $(element).data('url');

    if (confirm('Bạn có chắc chắn không? Nếu bạn chọn XÓA thì hình ảnh này sẽ mất vĩnh viễn khỏi hệ thống')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                if (result && result.error === false) {
                    alert('Xóa hình ảnh thành công');
                    location.reload(); // Load lại trang
                } else {
                    alert('Xóa sản phẩm không thành công. Vui lòng thử lại');
                }
            },
        });
    }
}



