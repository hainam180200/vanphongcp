@extends('frontend.layouts.master_blog')
@section('seo_head')
@include('frontend.widget.__seo_head')
@endsection
@push('style')
<link rel="stylesheet" href="/assets/frontend/css/news.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
@endpush
@push('js')
<script type='text/javascript' src='/assets/frontend/lib/jquery.min.js'></script>
<script type='text/javascript' src='/assets/frontend/lib/jquery-migrate.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
@endpush
@section('content')
<article id="post-59015" class="td-post-template-3 post-59015 post type-post status-publish format-standard has-post-thumbnail  td-container-wrap" itemscope itemtype="https://schema.org/Article">
   <div class="td-post-header td-container">
      <div class="td-crumb-container"></div>
       @if(isset($data->image))
      <div class="td-post-header-holder td-image-gradient">
         <div class="td-post-featured-image">
            <a href="/blog/{{ isset($data->url)?$data->url:$data->slug }}" data-caption="">
            @if(isset($data->image) && $data->image!=null)
            <img width="1068" height="601" class="entry-thumb td-modal-image" src="{{isset($data->image)?\App\Library\Files::media($data->image) : null }} "/>
            @endif
            </a>
         </div>
         <header class="td-post-title">
            @if(isset($data->groups) && count($data->groups) > 0)
            <ul class="td-category">
               @foreach($data->groups as $group_item)
               <li class="entry-category">
                  <a  href="/blog{{isset($group_item->url) ? $group_item->url : $group_item->slug}}">{{$group_item->title}}</a>
               </li>
               @endforeach
            </ul>
            @endif
            <h1 class="entry-title">{{isset($data->title) ? $data->title : null}}</h1>
            <div class="td-module-meta-info">
               <div class="td-post-author-name">
                  <div class="td-author-by">Bởi</div>
                  @if(isset($data->author->fullname))
                  <a href="">{{isset($data->author->fullname) ? $data->author->fullname : $data->author->username}}</a>
                  @endif
                  <div class="td-author-line"> - </div>
               </div>
               <span class="td-post-date">
               <time class="entry-date updated td-module-date" >{{isset($data->created_at) ? $data->created_at : null}}</time>
               </span>
               <div class="td-post-views">
                  <i class="td-icon-views"></i>
                  <span class="td-nr-views-59015">{{isset($data->totalviews) ? $data->totalviews : null}}</span>
               </div>
            </div>
         </header>
      </div>
       @else
           <div class="td-pb-row">
               <div class="td-pb-span12">
                   <div class="td-post-header">
                       <div class="td-crumb-container"></div>
                       @if(isset($data->groups) && count($data->groups) > 0)
                           <ul class="td-category">
                               @foreach($data->groups as $group_item)
                                   <li class="entry-category">
                                       <a  href="/blog{{isset($group_item->url) ? $group_item->url : $group_item->slug}}">{{$group_item->title}}</a>
                                   </li>
                               @endforeach
                           </ul>
                       @endif
                       {{-- <ul class="td-category"><li class="entry-category"><a  href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot">Tin hot</a></li><li class="entry-category"><a  href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-nhanh-trong-ngay">Tin nhanh trong ngày</a></li><li class="entry-category"><a  href="https://hoanghamobile.com/tin-tuc/category/tin-tuc">Tin tức</a></li><li class="entry-category"><a  href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-tuc-cong-nghe">Tin tức công nghệ</a></li></ul> --}}
                       <header class="td-post-title">
                           <h1 class="entry-title">{{isset($data->title) ? $data->title : null}}</h1>
                           <div class="td-module-meta-info">
                               <div class="td-post-author-name"><div class="td-author-line"> - </div> </div>
                               <span class="td-post-date"><time class="entry-date updated td-module-date" >{{isset($data->created_at) ? $data->created_at : null}}</time></span>
                               <div class="td-post-views"><i class="td-icon-views"></i><span class="td-nr-views-163470">{{isset($data->totalviews) ? $data->totalviews : null}}</span></div>

                           </div>

                       </header>
                   </div>
               </div>
           </div> <!-- /.td-pb-row -->
       @endif
   </div>
   <div class="td-container">
      <div class="td-pb-row">
         <div class="td-pb-span8 td-main-content" role="main">
            <div class="td-ss-main-content">
               <div class="td-post-content tagdiv-type">
                  {!! isset($data->content)?$data->content:'' !!}
               </div>
               <footer>
                  <div class="td_block_wrap td_block_related_posts tdi_3_434 td_with_ajax_pagination td-pb-border-top td_block_template_1">
                     <h4 class="td-related-title td-block-title"><a id="tdi_4_cd4" class="td-related-left td-cur-simple-item" data-td_filter_value="" data-td_block_id="tdi_3_434" href="#">BÀI VIẾT LIÊN QUAN</a>`</h4>
                     <div class="td-related-row">
                        @if (isset($data_involve) && count($data_involve) > 0)
                           @foreach ($data_involve as $key => $item)
                              <div class="td-related-span4">
                                 <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                    <div class="td-module-image">
                                       <div class="td-module-thumb">
                                          <a href="{{ isset($item->url)?$item->url:$item->slug }}" rel="bookmark" class="td-image-wrap" title="{{ isset($item->title) ? $item->title : null }}">
                                                <img width="218" height="150" class="entry-thumb" src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}"  title="{{ isset($item->title) ? $item->title : null }}" />
                                             </a>
                                          </div>
                                       </div>
                                    <div class="item-details">
                                          <h3 class="entry-title td-module-title">
                                          <a href="{{ isset($item->url)?$item->url:$item->slug }}" rel="bookmark" title="{{ isset($item->title) ? $item->title : null }}">{{ isset($item->title) ? $item->title : null }}</a>
                                          </h3>
                                       </div>
                                 </div>
                              </div>
                           @endforeach
                        @endif
                  </div>
               </footer>
            </div>
         </div>
         <div class="td-pb-span4 td-main-sidebar" role="complementary">
            <div class="td-ss-main-sidebar">
               <div class="td_block_wrap td_block_2 td_block_widget tdi_6_027 td-pb-border-top td_block_template_1 td-column-1 td_block_padding"  data-td-block-uid="tdi_6_027" >
                  <div class="td-block-title-wrap">
                     <h4 class="block-title td-block-title">
                        <span class="td-pulldown-size">BÀI VIẾT MỚI</span>
                     </h4>
                  </div>
                  <div id=tdi_6_027 class="td_block_inner">
                     @if (isset($data_new) && count($data_new) > 0)
                        @foreach ($data_new as $key =>$item)
                           <div class="td-block-span12">
                              <div class="td_module_2 td_module_wrap td-animation-stack">
                                 <div class="td-module-image">
                                    <div class="td-module-thumb">
                                       <a href="{{ isset($item->url)?$item->url:$item->slug }}" rel="bookmark" class="td-image-wrap" title="{{ isset($item->title) ? $item->title : null }}">
                                       <img width="324" height="160" class="entry-thumb" src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}"  title="{{ isset($item->title) ? $item->title : null }}" />
                                       </a>
                                    </div>
                                    @if (isset($item->groups->title))
                                       <a href="/blog/{{ isset($item->groups->url)?$item->groups->url:$item->groups->slug }}" class="td-post-category">{{$item->groups->title}}</a>
                                    @endif
                                 </div>
                                 <h3 class="entry-title td-module-title">
                                    <a href="{{ isset($item->url)?$item->url:$item->slug }}" rel="bookmark" title="{{ isset($item->title) ? $item->title : null }}">{{ isset($item->title) ? $item->title : null }}</a>
                                 </h3>
                                 <div class="td-module-meta-info">
                                    <span class="td-post-date">
                                    <time class="entry-date updated td-module-date" datetime="2022-03-27T21:14:04+00:00" >{{$item->created_at->format('d-m-y H:i')}}</time>
                                    </span>
                                 </div>
                                 <div class="td-excerpt">
                                    {{$item->description}}
                                 </div>
                              </div>
                           </div>
                        @endforeach
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.td-pb-row -->
   </div>
   <!-- /.td-container -->
</article>
<!-- /.post -->
<!-- Instagram -->
<!-- Page generated by LiteSpeed Cache 4.4.7 on 2022-03-27 23:44:46 -->
@endsection
