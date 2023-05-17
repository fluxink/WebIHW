<div class="">
    <article class="grid no-padding no-elevate">
        <div class="s12 l6">
            <?php $image = $item->image ? $item->image : 'no-image.png'; ?>
            <img class="responsive" src="/assets/images/<?php echo $image ?>" alt="">
        </div>
        <div class="s12 l6 padding">
            <h3>
                <?php echo $item->name ?>
            </h3>
            <p class="large-text">
                <?php echo $item->description ?>
            </p>
            <div class="large-space"></div>
            <div class="s12 l6">
                <h4>
                    <?php echo $item->price ?> грн
                </h4>
            </div>
        </div>
    </article>
</div>