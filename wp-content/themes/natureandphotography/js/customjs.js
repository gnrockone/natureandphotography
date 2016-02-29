jQuery(document).ready( function(){
	//masonry homepage
	jQuery(".ms-item").css("margin-bottom","10px");
	jQuery(".ms-item").css("margin-top","10px");
	var $rowMasonry = jQuery('.ms-row');
	$rowMasonry.imagesLoaded( function () {
    	$rowMasonry.masonry({
    		columnWidth: '.ms-item',
    		itemSelector: '.ms-item',
    		isFitWidth: false
    	});
    });     
	//end of masonry home page
	
	//select text when input text form click
	jQuery("input").on("click",function(){
		this.select();
	});

	$('#load-more').on('click', function() {
    var $this = $(this);

    $.ajax({
        url: '?page_id=4',
        type: 'POST',
        data: {
            posts_per_page: 3
        },
        beforeSend: function() {
            $this.text('Loading...');
        },
        success: function(data) {
            if (data) {
                $('.ms-row').append(data);
                $this.text('Load more');
            } else {
                $this.text('No more');
            }
        },
        fail: function() {
            console.log('error');
        }
    })
  });
});