@if({{nbImages}} > 0 && {{blockGalleryActive}})
    @if({{blockGalleryLightbox}} == true)
        <script type="text/javascript">
            Shadowbox.init();
        </script>
    @endif
    <section id="RL_gallery">
        <header>
            <h1 class="RL_modTitle">{{blockGalleryTitle}}</h1>
            <a class="RL_moreButton" href="index.php?file=Gallery">{{*MORE}}</a>
        </header>
        <div>
            @foreach(blockGalleryContent as image)
                <figure>
                    @if({{image.link}} !== '#')
                        <a href="{{image.link}}" title="{{image.title}}" rel="shadowbox">
                    @endif
                            <img src="{{image.src}}" alt="{{image.title}}" />
                    @if({{image.link}} !== '#')
                        </a>
                    @endif
                </figure>
            @endforeach
        </div>
    </section>
@endif