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
                <h3> {{ $profile['username'] }} </h3>
            </th>
            <th>
                <a href="{{ URL('admin') }}"> home </a> > 
                <a href="{{ URL('admin/logout') }}"> logout </a>
            </th>
        </tr>
        <tr>
            <td>
                <h3> Admin Profile </h3>
            </td>
            <td>
                <ul>
                    <li> {{ $profile['email'] }} </li>
                    <li> {{ $profile['username'] }} </li>
                </ul>
            </td>
        </tr>
    </table>
</body>
</html>