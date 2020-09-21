<ul>
  <li ng-repeat="x in json">
  <h2><a href="#/second/{{ x.menu_id }}">{{ x.name }}</a></h2>
  <p>{{ x.content }}... <a href="#/second/{{ x.menu_id }}">More</a></p>
</ul>
