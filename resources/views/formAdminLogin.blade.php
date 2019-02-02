<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ URL('admin/login') }}" method="post">
        <table>
            <tr>
                <th colspan="2" align="center">
                    <h3> Admin Login </h3>
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
                    password: 
                </td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    @csrf
                    <button type="submit" name="button" value="1"> Login </button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>