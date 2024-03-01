
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore() {
    var page = $('#page').val();
    $.ajax({
        url: 'load-more',  
        type: 'post',
        data: { page: page },
        success: function(response) {          
            $('.isotope-grid1').append(response);  //.isotope-grid1 là div chứa tất cả các sản phẩm
            $('#page').val(parseInt(page) + 1);
           
            if (response.message == 'No more products to load') {
                $('#button-loadMore').hide();
            }

            // Scroll to the bottom of the newly added products
            var newProducts = $('.isotope-grid1').children().last();
            var offset = newProducts.offset().top - $(window).scrollTop();
            window.scrollBy({
                top: offset,
                behavior: 'smooth'
            });
        }
    });
}












