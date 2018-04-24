<?php
/*

  Template Name: Events

 */



get_header();

$argsEvents = array(

    'offset' => 0,

    'orderby' => 'post_date',

    'category' => '',

    'post_type' => 'events',

    'post_status' => 'publish',

    'order' => 'DESC',

    'posts_per_page'   =>9999,

);

$events = get_posts($argsEvents);

?>
<div class="container">

    <?php foreach($events as $event):  ?>
        <article class="uk-article event">
            <div class="event-container">
                <?php
                    $event_image = wp_get_attachment_image_src(get_post_thumbnail_id($event->ID), 'full');

                    $event_title = $event->post_title;

                    $event_content = $event->post_content;

                    $website = get_field('website',$event->ID);
                    ?>
                <?php if(!empty($event_image)): ?>
                    <p>
                        <a href="<?php echo $website; ?>">
                            <img class="alignnone size-full wp-image-1904" src="<?php echo $event_image[0]; ?>" alt="" width="408" height="190"/>
                        </a>
                    </p>
                <?php endif; ?>
                <?php if(!empty($event_title)): ?>

                    <h4><a href="<?php echo $website; ?>"><?php echo $event_title; ?></a></h4>

                <?php endif; ?>

                <?php if(!empty($event_content)): ?>

                    <p><?php echo $event_content; ?></p>

                <?php endif; ?>

                <?php
                    $event_date_start = get_field('date_start',$event->ID);
                    $event_date_end = get_field('date_end',$event->ID);

                ?>
                <?php if(!empty($event_date_start) && !empty($event_date_end)): ?>

                    <p>Start Date: <?php echo $event_date_start; ?></p>
                    <p>Last Date: <?php echo $event_date_end; ?></p>
                <?php endif; ?>


            </div>
        </article>
    <?php endforeach; ?>


</div>


<?php
get_footer();
?>
