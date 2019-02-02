<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ URL('register') }}" method="post">
        <table>
            <tr>
                <th colspan="2" align="center">
                    <h3> Register </h3>
                </th>
            </tr>
            @if($errors->any())
                <tr>
                    <td colspan="2" align="center" border="1">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endif
            <tr>
                <td>
                    email:
                </td>
                <td>
                    <input type="email" name="email">
                </td>
            </tr>
            <tr>
                <td>
                    username:
                </td>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <td>
                    password: 
                </td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td>
                    password-confirm: 
                </td>
                <td>
                    <input type="password" name="passwordConfirm">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    @csrf
                    <button type="submit" name="button" value="1"> Register </button>
                    <button type="submit" name="button" value="2"> Login </button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>