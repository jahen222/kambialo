<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        table {
            width: 50vw;
            text-align: center;
        }

        .img-div {
            width: 50%;
            margin: auto;
        }

        .btn {
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
            display: inline-block;
            padding: 15px;
            border-radius: 2px;
            background-color: #4285f4;
            color: white;
            text-decoration: none;
        }

        @media only screen and (max-device-width: 640px) {
            table {
                width: 60vw;
                text-align: center;
            }

            .img-div {
                width: 60%;
                margin: auto;
            }
        }

        @media only screen and (max-device-width: 479px) {
            table {
                width: 100vw;
                text-align: center;
            }

            .img-div {
                width: 100%;
                margin: auto;
            }
        }

    </style>
</head>

<body>
    <table align="center">
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
						url()->to('images/' . $userMatch->products()->whereIn(
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
						url()->to('images/' . $user->products()->whereIn(
							'id', array_column($userMatch->favorites()->get()->toArray(), 'product_id')
						)->first()->cover_image) }}" alt="">
                </div>
            </td>
        </tr>
        <tr>
            <td align="center">
                <a class="btn" href="{{ route('match.show', $match->id) }}">VER MATCH</a>
            </td>
        </tr>
    </table>
</body>

</html>

<head>
