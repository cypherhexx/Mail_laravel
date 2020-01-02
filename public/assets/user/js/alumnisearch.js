
$('#search').keyup(function() {

	if($(this).val()){

  $.ajax({
    url: 'search',
    type: 'post',
    data: {'data':$('input[name=search]').val(), '_token': $('meta[name="csrf-token"]').attr('content')},
   
      success: function(data){
        $('.showsearch').html(data);
      }
  });

  $.ajax({
    url: 'searchcount',
    type: 'post',
    data: {'data':$('input[name=search]').val(), '_token': $('meta[name="csrf-token"]').attr('content')},
   
      success: function(data){
        $('.search-count').html( "<h2> "+ data + "  results found for: <span class='text-navy'>"+ $('input[name=search]').val().toUpperCase() +"</span></h2>" );
      }
  });
}
else {
 $('.search-count').html('<h2> <span class="text-red"> Please enter name </span> </h2>')
 $('.showsearch').html('<div class="search-result"><h3><a href="#">Sorry, No  records matching with this key.</a></h3><p>No  records matching with this key,please search another </p></div>')

}

});
