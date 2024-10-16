<header>
    <div class="top">
        <div class="menu">
            <a href="javascript:;" id="menuToggle"><i class="fas fa-bars"></i></a>
        </div>
        <div class="logo">
            <a href="/"><img src="{{\App\Library\Files::media(setting('sys_logo'))}}" /></a>
        </div>
        <div class="cart">
            <a href="/cart"><i class="fas fa-shopping-cart" style="padding-right: 8px"></i>
                <span id="cart-total">
                    <b>
                        @php
                            if (Cookie::has('shopping_cart')){
                                $data_shopping_cart = collect(json_decode(Cookie::get('shopping_cart')));
                                $count_shopping_cart = $data_shopping_cart->sum('qty');
                            }
                            else{
                                $count_shopping_cart = 0;
                            }
                            echo $count_shopping_cart;
                        @endphp
                    </b>
                </span>
            </a>
        </div>
    </div>

    <div class="search-box">
        <form method="get" action="/item-list" class="formSearchHeader"  enctype="application/x-www-form-urlencoded">
            <div class="border">
                <input type="text" id="searchFrom"  name="q" placeholder="Hôm nay bạn cần tìm gì?"  autocomplete="off" />
                <button type="submit" ><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="autocomplete-suggestions hihi" style=" ">
        <div class="autocomplete-suggestion" id="result-search">

        </div>
    </div>
    <script>
        $(document).ready(function(){
            const hostname = window.location.pathname;
            function IsJsonString(str) {
                try {
                    JSON.parse(str);
                } catch (e) {
                    return false;
                }
                return true;
            }

            var page = 1;
            $("body").on('click', '.nav-search-in-value-load-more', function(e) {
                e.preventDefault();
                var q = $('#searchFrom').val();
                page++;
                search(q,page);
            });

            ;(function($){
                $.fn.extend({
                    donetyping: function(callback,timeout){
                        timeout = timeout || 1e3; // 1 second default timeout
                        var timeoutReference,
                            doneTyping = function(el){
                                if (!timeoutReference) return;
                                timeoutReference = null;
                                callback.call(el);
                            };
                        return this.each(function(i,el){
                            var $el = $(el);
                            // Chrome Fix (Use keyup over keypress to detect backspace)
                            // thank you @palerdot
                            $el.is(':input') && $el.on('keyup keypress paste',function(e){
                                // This catches the backspace and DEL button in chrome, but also prevents
                                // the event from triggering too preemptively. Without this line,
                                // using tab/shift+tab will make the focused element fire the callback.
                                if (e.type=='keyup' && !([8,46].includes(e.keyCode))){return;}

                                // Check if timeout has been set. If it has, "reset" the clock and
                                // start over again.
                                if (timeoutReference) clearTimeout(timeoutReference);
                                timeoutReference = setTimeout(function(){
                                    // if we made it here, our timeout has elapsed. Fire the
                                    // callback
                                    doneTyping(el);
                                }, timeout);
                            }).on('blur',function(){
                                // If we can, fire the event since we're leaving the field
                                doneTyping(el);
                            });
                        });
                    }
                });
            })(jQuery);

            $('#searchFrom').donetyping(function() {

                var q = $(this).val();
                if(q == null || q === "" || q === undefined){
                    $('.hihi').css('display','none');
                    return false;
                }
                search(q);
            }, 300);
            function search(q, append = false) {
                $.ajax({
                    type: 'GET',
                    url: '/tim-kiem',
                    data: {
                        q:q
                    },
                    beforeSend: function (xhr) {

                    },
                    success: (data) => {
                        let html = "";
                        let html1 = "";
                        console.log(data)
                        if(data.status == 1){
                            if(data.data.length === 0){
                                html += '<div style="color:#f63;padding: 20px;text-align: center;font-weight: 700;justify-content: center" class="search-item" id="nav-search_none">';
                                html += 'Không tìm thấy sản phẩm';
                                html += '</div>';

                                $('#result-search').html(html);
                                $('.hihi').css('display','block');
                                // $('.nav-search-in-value-load-more').css('display','none');
                            }
                            else{
                                $.each(data.data,function(key,value){
                                    console.log(value.title)
                                    html += '<div class="search-item">';
                                    html += '<div class="img">';

                                    html += '<img src="/storage'+value.image+'" alt="">';
                                    // if(jQuery.parseJSON(value.image) && jQuery.parseJSON(value.image)){
                                    //     html += '<img src="'+media+jQuery.parseJSON(value.image)+'" alt="">';
                                    // }
                                    html += '</div>';
                                    html += '<div class="info">';
                                    html += '<h2><a href="';
                                    if(value.url != null ){
                                        html += value.url;
                                    }else{
                                        html += value.slug;
                                    }
                                    html += '">';
                                    html += value.title;
                                    html += '</a></h2>';
                                    html += '<h3>' +value.price+'</h3>';

                                    html += '</div>';
                                    html += '</div>';
                                });
                                $('.hihi').css('display','block');

                                $('#result-search').append(html);

                                // if(data.data.current_page == 1){
                                //
                                //     $('#result-search').html(html);
                                //     if(data.appen === 0){
                                //         $('.nav-search-in-value-load-more').css('display','none');
                                //     }
                                //     else{
                                //         $('.nav-search-in-value-load-more').css('display','block');
                                //     }
                                // }
                                // else{
                                //     console.log(333)
                                //     $('#result-search').append(html);
                                // }
                                // $('.hihi').css('display','block');
                            }
                        }
                        else{
                            console.log(111)
                            $('.hihi').css('display','none');
                        }
                    },
                    error: function (data) {

                    },
                    complete: function (data) {

                    }
                });
            }



        })

    </script>
</header>
{!! widget('frontend.widget.mobile._menu_category') !!}
