
$(document).ready(function() {
    $('#products_table').DataTable({
        "paging": true,     // Enable pagination
        "searching": true   // Enable search bar
    });

    $('#orders_table').DataTable({
        "paging": true,     // Enable pagination
        "searching": true   // Enable search bar
    });


    $('#phone_number').on('input', function(){
        var number = $(this).val();
        if(number.length == 11) {
            $.ajax({
                type: 'GET',
                url: '/find_customer/' + number,
                success : function(response) {
                    if (response && response.success) {
                        console.log(response);
                        $('#full_name').val(response.data.full_name);
                        $('#age').val(response.data.age);
                    }
                }
            })

        }
    })

    $('.product_select').on('change', function(){
        var product_name = $(this).val();
        var product_price = $(this).find('option:selected').data('price');
        var product_max_quantity = $(this).find('option:selected').data('max_quantity');
        console.log(product_price);
        $('#display_price').text(product_price);
        $('#max_quantity').text( product_max_quantity);

    })

    // $(document).ready(function() {
    //     $('#addOrderBtn').on('click', function() {
    //         // Clone the original form and append it
    //         var $newForm = $('.order-form').first().clone();
    //         $newForm.find('input').val(''); // Clear input values
    //         $('#orderForms').append($newForm);
    //     });
    // });
    
});