<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th align="center">
                <h3> Wellcome Admin </h3>
            </th>
            <th>
                <a href="{{ URL('admin/profile') }}"> {{ $profile['username'] }} </a> |
                <a href="{{ URL('admin/logout') }}"> Logout </a>
            </th>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <a href="{{ URL('admin/category') }}"> Manage Category </a>
            </td>
        </tr>
    </table>
</body>
</html>