$(document).ready(function() {
    $('#floatingInput').autocomplete({
        source: function(request, response) {
            
            $.ajax({
                url: 'suggest.php',
                type: 'POST',
                dataType: 'json',
                data: { term: request.term },
                success: function(data) {
                    response(data.suggestions);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        },
        minLength: 2 
    });
    
});
