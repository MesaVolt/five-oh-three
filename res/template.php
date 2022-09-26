<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Maintenance en cours...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="robots" content="noindex">
    <?php if ($options['auto_refresh']) { ?>
        <meta http-equiv="refresh" content="<?php echo $options['auto_refresh_interval']; ?>">
    <?php } ?>

    <style>
        html {
            line-height: 1.15;
        }
        body, html {
            height: 100%;
            color: #212529;
        }
        body {
            margin: 0;
            /* @see https://getbootstrap.com/docs/5.2/content/reboot/#native-font-stack */
            font-family: system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans","Liberation Sans",Arial,sans-serif;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            margin-bottom: 0;
        }
        p {
            opacity: 0.7;
            text-align: center;
            max-width: 300px;
        }

        <?php if ($options['auto_refresh']) { ?>
            @keyframes loader {
                from {
                    width: 0;
                }
                to {
                    width: 100%;
                }
            }
            .loader {
                position: absolute;
                bottom: 0;
                left: 0;
                height: 4px;
                background-color: #007bff;
                animation-name: loader;
                animation-duration: 8s;
                animation-fill-mode: forwards;
            }
        <?php } ?>
    </style>
</head>

<body>
<img src="<?php echo $options['icon'] ?>" />

<h1>Maintenance en cours</h1>
<p>
    Une opération de maintenance est en cours, veuillez patienter quelques instants.
    <?php if ($options['auto_refresh']) { ?>
    <br />
    La page se rechargera automatiquement&hellip;
    <?php } ?>
</p>

<?php if ($options['auto_refresh']) { ?>
    <div class="loader"></div>
<?php } ?>
</body>
</html>
