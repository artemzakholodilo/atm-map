<h3>Project deploy</h3>
<ol>
    <li>docker-compose build</li>
    <li>docker-compose up -d</li>
    <li>docker-compose exec backend bash</li>
    <li>composer install --prefer-dist</li>
    <li>php init([0] - Development)</li>
    <li>php yii init-atm</li>
</ol>

<h3>Assign roles</h3>
<ul>
    <li>Admin role: php yii rbac/assign-admin {userId}</li>
    <li>Super admin role: php yii rbac/assign-super-admin {userId}</li>
</ul>

<p>
    To update atm list after "Update list" click run php yii update-atm
</p>