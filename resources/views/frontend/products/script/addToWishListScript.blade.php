<script>
    $(document).ready(function () {
        $('.wishlist-heart').click(function () {
            var productId = $(this).data('product-id');
            var action = $(this).hasClass('active') ? 'remove' : 'add';
            let that = $(this);
            $.ajax({
                type: 'POST',
                url: action === 'add' ? '{{route("addToWishlist")}}' : '{{route("removeFromWishlist")}}',
                data: { product_id: productId },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (action === 'add') {
                        that.addClass('active');
                    } else {
                        that.removeClass('active');
                        that.parents('.productCardDiv').remove();
                    }
                    alert(response.message); 
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseJSON.error); 
                }
            });
        });
    });
</script>