<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preview</title>
    <style>
        *, {
            margin:0;
            padding: 0;
        }
        body. html {
            height: 100%;
            position: relative;
        }
        .fid-align {
            display: block;
            width: 70%;
            height: 100%;
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            left: 15%;
            
        }
        .fid-preview {
            display: block;
            max-width: 100%;
            max-height: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            box-sizing: border-box;
            box-shadow: 0 0 100px rgba(0, 0, 0, 0.3);
        }
        .fid-specs {
            display: block;
            padding: 25px;
            box-sizing: border-box;
            background: rgba(0, 0, 0, 0.80);
            width: 200px;
            //height: 100%;
            position: absolute;
            top: 0;
            right: 0;
            text-align: left;
        }
        .fid-preview p {
            color: #fff;
            margin: 15px 0;
            font-family: monospace;
        }

        .fid-preview p:first-child {
            margin: 0 0 15px 0;
        }
        .fid-preview p:last-child {
            margin: 15px 0 0 0;
        }

        .fid-preview p span {
            display: block;
            line-height: 1em;
            overflow-wrap: break-word;
        }
        .fid-preview p small {
            font-size: .8em;
            opacity: .7;
        }
        .fid-preview img {
            cursor: crosshair;
        }
        .close {
            color: #fff;
            width: 40px;
            height: 40px;
            font-size: 2.4em;
            position: absolute;
            top: -40px;
            right: 0;
            cursor: pointer;
        }
        hr {
            height: 0;
            border: none;
            border-top: solid 1px #666;
            margin: 20px 0;
        }
        .clear {
            display:block;
            width: 100%;
        }
    </style>
</head>
<body>
<?php
    require_once('../../../wp-load.php');
    $path               = $_GET['path'];
    $post_ID            = $_GET['postID'];
    $image_data         = wp_get_attachment_metadata( get_post_thumbnail_id( $post_ID ) );
   
    $width              = $image_data['width'];
    $height             = $image_data['height'];
    $file_path          = $image_data['file'];

    $camera             = $image_data['image_meta']['camera'];
    $focal_length       = $image_data['image_meta']['focal_length'];
    $iso                = $image_data['image_meta']['iso'];
    $shutter_speed      = $image_data['image_meta']['shutter_speed'];
    $aperture           = $image_data['image_meta']['aperture'];
    $created_timestamp  = $image_data['image_meta']['created_timestamp'];
    $image_alt          = get_post_meta( get_post_thumbnail_id( $post_ID ), '_wp_attachment_image_alt', true);
    $image_caption      = get_post_meta( get_post_thumbnail_id( $post_ID ), '_wp_attachment_image_caption', true);

?>
<div class="fid-align">
    <div class="fid-preview">
        <span class="dashicons dashicons-no close"></span>
        <img src="<?php echo $path; ?>" />
        <div class="fid-specs">
            <p>
                <small><?php _e( 'Width', 'fid' ); ?></small>
                <span><?php echo $width; ?>px</span>
            </p>
            <p>
                <small><?php _e( 'Height', 'fid' ); ?></small>
                <span><?php echo $height; ?>px</span>
            </p>
            <p>
                <small><?php _e( 'File Path', 'fid' ); ?></small>
                <span><?php echo $file_path; ?></span>
            </p>

            <?php if($image_alt) { ?>
            <p>
                <small><?php _e( 'Alt', 'fid' ); ?></small>
                <span><?php echo $image_alt; ?></span>
            </p>
            <?php } ?>

            <?php if($camera) { ?>
            <p>
                <small><?php _e( 'Camera', 'fid' ); ?></small>
                <span><?php echo $camera; ?></span>
            </p>
            <?php } ?>

            <?php if($focal_length) { ?>
            <p>
                <small><?php _e( 'Focal length', 'fid' ); ?></small>
                <span><?php echo $focal_length; ?></span>
            </p>
            <?php } ?>

            <?php if($iso) { ?>
            <p>
                <small><?php _e( 'ISO', 'fid' ); ?></small>
                <span><?php echo $iso; ?></span>
            </p>
            <?php } ?>

            <?php if($shutter_speed) { ?>
            <p>
                <small><?php _e( 'Shutter Speed', 'fid' ); ?></small>
                <span><?php echo $shutter_speed; ?></span>
            </p>
            <?php } ?>
            
            <?php if($aperture) { ?>
            <p>
                <small><?php _e( 'Aperture', 'fid' ); ?></small>
                <span><?php echo $aperture; ?></span>
            </p>
            <?php } ?>

            <?php if($created_timestamp) { ?>
            <p>
                <small><?php _e( 'Timestamp', 'fid' ); ?></small>
                <span><?php echo $created_timestamp; ?></span>
            </p>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    jQuery('.close').click(function() {
        jQuery('.fid-mask, .fid-window').fadeOut();
    });
    jQuery('img').click(function() {
        jQuery('.fid-specs').fadeToggle();
    });
</script>
</body>
</html>