$(document).ready(function(){
    $('.menu-icon').click(function(){
        $('.main-menu').toggleClass('open');
    });
});
var currentIndex = 0;
setInterval(function() {
    let data = $('.article-item.active').data("index");
    $('.article-item').removeClass('active');
    currentIndex = data + 1;
    if (currentIndex >= 6){
        currentIndex = 0;
    }
    $('.article-item').eq(currentIndex).addClass('active');
    let image =  $('.article-item.active .article-image').html();
    let text =  $('.article-item.active .article-text').html();
    let html = `<a href="#" >
                    <div class="article-content-img">
                        ${image}
                    </div>
                    <div class="c-p-8">
                        ${text}
                    </div>
                </a>`;
    $("#article-content").html(html)
}, 5000);

// scrolling
let $list = $('.steering-scroll-list ul');
let listHeight = $list.height();
let itemHeight = $list.find('li').outerHeight();
let scrollSpeed = 50; // Tốc độ cuộn, càng nhỏ càng nhanh

// Sao chép nội dung danh sách để tạo hiệu ứng lặp
$list.append($list.html());

// Hàm cuộn mượt liên tục
function scrollList() {
    $list.animate(
        { top: `-=${itemHeight}` },
        scrollSpeed * itemHeight,
        'linear',
        function() {
            $list.css('top', '0');
            scrollList();
        }
    );
}
// Bắt đầu cuộn
scrollList();
// Dừng cuộn khi di chuột vào
$('.steering-scroll-list').hover(
    function() {
        $list.stop();
    },
    function() {
        scrollList();
    }
);

