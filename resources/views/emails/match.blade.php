<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        .container {
            width: 100%;
            background-color: #e2dfdf;
            padding: 20px 0;
        }

        table {
            width: 40%;
            text-align: center;
            background-color: white;
            border-radius: 10px;
        }

        .pt-10{
            padding-top: 10px;
        }
        .pb-10{
            padding-bottom: 10px;
        }

        .img-logo {
            width: 30%;
            margin-right: auto;
        }

        .img-div {
            width: 60%;
            margin: auto;
        }

        .btn {
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
            display: inline-block;
            padding: 15px;
            border-radius: 2px;
            background-color: #4285f4;
            color: white!important;
            text-decoration: none;
        }

        @media only screen and (max-device-width: 640px) {
            table {
                width: 60%;
                text-align: center;
            }

            .img-logo {
                width: 50%;
                margin-right: auto;
            }

            .img-div {
                width: 60%;
                margin: auto;
            }
        }

        @media only screen and (max-device-width: 479px) {
            table {
                width: 100%;
                text-align: center;
            }

            .img-logo {
                width: 100%;
                margin-right: auto;
            }

            .img-div {
                width: 100%;
                margin: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <table align="center">
            <tr class="pt-10">
                <td>
                    <div class="img-logo">
                        <img style="max-width:100%;" src="{{ url()->to('images/logo.png') }}" alt="">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <h1>Match con {{ $userMatch->name }}</h1>
                </td>
            </tr>
            <tr>
                <td>Email: {{ $userMatch->email }}</td>
            </tr>
            <tr>
                <td>Mensaje:
                    {{ $match->user_id_1 == $userMatch->id ? $match->user_id_1_message : $match->user_id_2_message }}</td>
            </tr>
            <tr>
                <td>
                    <h3>Tus matchs con {{ $userMatch->name }}</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="img-div">
                        <img style="width:100%;" src="{{
						url()->to(config('constants.publicUrl') . 'images/' . $userMatch->products()->whereIn(
							'id', array_column($user->favorites()->get()->toArray(), 'product_id')
                        )->first()->cover_image) }}" alt="">
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <h3>A {{ $userMatch->name }} le gusto</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="img-div">
                        <img style="width:100%;" src="{{
						url()->to(config('constants.publicUrl') . 'images/' . $user->products()->whereIn(
							'id', array_column($userMatch->favorites()->get()->toArray(), 'product_id')
                        )->first()->cover_image) }}" alt="">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="pb-10" align="center">
                    <a class="btn" href="{{ route('match.show', $match->id) }}">VER MATCH</a>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>