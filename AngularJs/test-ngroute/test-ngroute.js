angular.module('app', ['ngRoute'])
.controller('ctr1', function($scope) {
  $scope.a = 1;
  $scope.b = 2;
  $scope.c = $scope.a + $scope.b;
  $scope.today = new Date();
  $scope.change = function() {
    location.href = 'http://www.baidu.com';
  }
})
//服务$routeParams保存了地址栏中的参数，例如{id : 1, name : 'tom'}
.controller('MainController', function($scope, $route, $routeParams, $location) {
        $scope.$route = $route;
        $scope.$location = $location;
        $scope.$routeParams = $routeParams;
        console.log($location);
        console.log('main route Params: ');
        console.log($routeParams);
 })

 .controller('BookController', function($scope, $routeParams) {
        $scope.name = "BookController";
        $scope.params = $routeParams;
        console.log('book route Params: ');
        console.log($routeParams);
 })

 .controller('ChapterController', function($scope, $routeParams) {
        $scope.name = "ChapterController";
        $scope.params = $routeParams;
        console.log('chapter route Params: ');
        console.log($routeParams);
 })

.config(function($routeProvider, $locationProvider) {
    //服务$routeProvider用来定义一个路由表，即地址栏与视图模板的映射
    $routeProvider
    /**
     *when(path,route)方法接收两个参数，path是一个string类型，表示该条路由规则所匹配的路径，它将与地址栏的内容( $location.path) 值进行匹配。如果需要匹配参数，可以在path中使用冒号加名称的方式，如：path为/show/:name，如果地址栏是/show/tom，那么参 数name和所对应的值tom便会被保存在$routeParams中，像这样：{name : tom}。我们也可以用*进行模糊匹配，
     *如：/show/:name将匹配/showInfo/tom
     * route参数是一个object，用来指定当path匹配后所需的一系列配置项，包括以下内容：
     * controller //function或string类型。在当前模板上执行的controller函数，生成新的scope
     * controllerAs //string类型，为controller指定别名
     * template //string或function类型，视图所用的模板，这部分内容将被ngView引用
     * templateUrl //string或function类型，当视图模板为单独的html文件或是使用了<script type="text/ng-template">定义模板时使用
     * resolve //指定当前controller所依赖的其他模块
     * redirectTo //重定向的地址
     */
    .when('/Book/:bookId', {
        templateUrl: 'book.html',
        controller: 'BookController',
        resolve: {
          // I will cause a 1 second delay
          delay: function($q, $timeout) {
            var delay = $q.defer();
            console.log('$q ' + $q);
            $timeout(delay.resolve, 1000);
            return delay.promise;
          }
        }
    })
    .when('/Book/:bookId/ch/:chapterId', {
        templateUrl: 'chapter.html',
        controller: 'ChapterController'
    })
    /*
    otherwise(params)方法对应路径匹配不到时的情况
     */
    .otherwise({
        redirectTo: '/Book/:bookId'
    });

    // configure html5 to get links working on jsfiddle
    // $locationProvider.html5Mode(true);
});