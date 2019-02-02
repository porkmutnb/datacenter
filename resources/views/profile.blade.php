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
                <h3> {{ Auth::User()->username }} </h3>
            </th>
            <th>
                <a href="{{ URL('/') }}"> home </a> > 
                <a href="{{ URL('logout') }}"> logout </a>
            </th>
        </tr>
        <tr>
            <td>
                <h3> Profile </h3>
            </td>
            <td>
                <ul>
                    <li> {{ Auth::User()->email }} </li>
                    <li> {{ Auth::User()->username }} </li>
                </ul>
            </td>
        </tr>
    </table>
</body>
</html>