<h1>New login detetted</h1>

<p>A login has been detected from a new device/browser</p>

<ul>
    <li>Location: {{ $loginData['location'] }}</li>
    <li>Device/Browser: {{ $loginData['user_agent'] }}</li>
    <li>Date: {{ $loginData['login_at']->day }} {{ $loginData['login_at']->shortEnglishMonth }},
        {{ $loginData['login_at']->year }} - {{ $loginData['login_at']->hour }} : {{ $loginData['login_at']->minute }}
    </li>
</ul>

<p>Thanks</p>
