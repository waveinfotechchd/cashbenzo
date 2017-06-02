 <style>
            /****** Rating Starts *****/
            @import url(http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

            fieldset, label { margin: 0; padding: 0; }
            
            h1 { font-size: 1.5em; margin: 10px; }

            .rating { 
                border: none;
                float: left;
            }

            .rating > input { display: none; } 
            .rating > label:before { 
                margin: 2px;
                font-size: 0.9em;
                font-family: FontAwesome;
                display: inline-block;
                content: "\f005";
            }

            .rating > .half:before { 
                content: "\f089";
                position: absolute;
            }

           .rating > label { 
                color: #ddd; 
                float: right; 
            }
            .rating > input:checked ~ label, 
            .rating:not(:checked) > label:hover,  
            .rating:not(:checked) > label:hover ~ label { color: #FFA500;  }

            .rating > input:checked + label:hover, 
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label, 
            .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }     

.list-inline #dynmicstar {
    line-height: 4px;
}
            /* Downloaded from http://devzone.co.in/ */
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
                        $(document).ready(function () {
                        $("#dynmicstar").hide();
                        $("#staticstar").show();
                        $('#staticstar').mouseenter(function () {
                        $("#staticstar").hide();
        $("#dynmicstar").show();
        $("#dynmicstar").mouseleave(function () {
            $("#dynmicstar").hide();
             $("#staticstar").show();
        });
        });
                            $("#demo1 .stars").click(function () {
                           
                                $.get('/rating',{rate:$(this).val(),store:$("#storewe").val(),category:$("#categorywe").val()},function(d){
                                    if(d>0)
                                    {
                                        alert('You already rated');
                                    }else{
                                        alert('Thanks For Rating');
                                    }
                                });
                                
                                $(this).attr("checked");
                            });
                             
                        });
                    </script>
                      <fieldset id='demo1' class="rating">
                        <input class="stars" type="radio" id="star5" name="rating" value="5" />
                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input class="stars" type="radio" id="star4" name="rating" value="4" />
                        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input class="stars" type="radio" id="star3" name="rating" value="3" />
                       <label class = "full" for="star3" title="Good- 3 stars"></label>
                       <input class="stars" type="radio" id="star2" name="rating" value="2" />
                        <label class = "full" for="star2" title="bad - 2 stars"></label>
                        <input class="stars" type="radio" id="star1" name="rating" value="1" >
                        <label class = "full" for="star1" title="very bad - 1 star"></label>
                     </fieldset>
                     
                       