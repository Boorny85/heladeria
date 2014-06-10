<section class="alert alert-info"><h3>Bienvenidos A La Heladeria El Valenciano</h3></section>
<section class="box4 col-xs-12 col-sm-9">
    <section class="slider">
      <ul class="slides">
        <?= mostrarImagenes('./imagenes/slide/'); ?>
      </ul>
    </section>
</section>
<section class="col-xs-12 col-sm-3">
    <a class="twitter-timeline" 
       data-dnt="true" 
       href="https://twitter.com/H_El_Valenciano" 
       data-widget-id="470641085274812416">
       Tweets por @H_El_Valenciano
    </a>
</section>
<script>
    $('.slider').glide({
        autoplay: 3000,
        arrows: true,
        navigation: true,
        circular: false
    });
</script>
<script>
    !function(d,s,id){
        var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
        if(!d.getElementById(id)){
            js=d.createElement(s);
            js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js,fjs);
        }
    }(document,"script","twitter-wjs");
</script>
