<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Webhook Whatsapp API</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            background: #191919;
            color: #ffffff;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 760px;
        }

        .card {
            background: #1f1f1f;
            border: 1px solid #393939;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            padding: 32px;
        }

        h1 {
            margin: 0 0 24px;
            font-size: 2rem;
        }

        dl {
            margin: 0;
            display: grid;
            gap: 18px;
        }

        .row {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 16px;
            align-items: start;
        }

        dt {
            font-weight: 700;
            color: #9a9a9a;
        }

        dd {
            margin: 0;
            word-break: break-word;
            color: #1db0ff;
        }

        @media (max-width: 640px) {
            .card {
                padding: 24px;
            }

            .row {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="card">
            <h1>API</h1>

            <dl>
                <div class="row">
                    <dt>Nombre</dt>
                    <dd style="color: #ffffff;">Webhook Whatsapp</dd>
                </div>

                <div class="row">
                    <dt>Version</dt>
                    <dd style="color: #ffffff;">1.0.1</dd>
                </div>

                <div class="row">
                    <dt>Repositorio</dt>
                    <dd>
                        git@github.com:IDEA-systems/laravel-webhook-whatsapp.git
                    </dd>
                </div>
            </dl>
        </section>
    </main>
</body>
</html>