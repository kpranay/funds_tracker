<div ng-app ="cheque_booksApp" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div ng-controller ="Cheque_bookCtrl as cheque_bookCtrl">
        <form class="form-inline" ng-submit="cheque_bookCtrl.add()" name="addCheque_book">            
            <div class="form-group">
              <label for="exampleInputName2">Bank Account</label>
              <input type="text" class="form-control" ng-model="cheque_bookCtrl.newCheque_book.account_id"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputEmail2">Bank ID</label>
              <select class="form-control" ng-model="cheque_bookCtrl.newBank_account.bank_id" 
                  ng-options="bank.bank_id as bank.bank_name for bank in cheque_bookCtrl.banks">                          
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputName2">From Cheque Number</label>
              <input type="text" class="form-control" ng-model="cheque_bookCtrl.newCheque_book.from_cheque"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">To Cheque Number</label>
              <input type="text" class="form-control" ng-model="cheque_bookCtrl.newCheque_book.to_cheque"/>              
            </div>            
            <input type="submit" class="btn btn-default" value="Add" ng-disabled="addCheque_book.$invalid">
        </form>    
        
        <h3>Cheque_books Added</h3>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>                    
                    <th>Cheque book ID</th>
                    <th>Bank Account</th>
                    <th>Bank</th>
                    <th>From Cheque Number</th>
                    <th>To Cheque Number</th>
                </tr>
            </thead>
            <tr class="success" ng-repeat="cheque_book in cheque_bookCtrl.cheque_books">
                <td ng-bind="cheque_book.cheque_book_id"></td>                
                <td ng-bind="cheque_book.account_id"></td>
                <td ng-bind="cheque_book.bank_id"></td>                
                <td ng-bind="cheque_book.from_cheque"></td>
                <td ng-bind="cheque_book.to_cheque"></td>                
          <!--      <td ng-bind="cheque_book.cheque_book_group_name"></td> -->
            </tr>
            <tr class="active">
                <td>{{ cheque_bookCtrl.newCheque_book.cheque_book_id }}</td>  
                <td>{{ cheque_bookCtrl.newCheque_book.account_id }}</td>
                <td>{{ cheque_bookCtrl.newCheque_book.bank_id }}</td>                
                <td>{{ cheque_bookCtrl.newCheque_book.from_cheque }}</td>
                <td>{{ cheque_bookCtrl.newCheque_book.to_cheque }}</td>                
     <!--           <td>{{ cheque_bookCtrl.newCheque_book.cheque_book_group_id }}</td> -->
            </tr>
        </table>
        
        <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.js"></script>
        <script>
          angular.module('cheque_booksApp', [])
            .controller('Cheque_bookCtrl', ['$http', function($http) {
              var self = this;
              self.cheque_books = [];
              self.banks = [];
              self.partys = [];
              self.cheque_book_groups = [];
              self.newCheque_book = {};
              var fetchcheque_books = function() {
                return $http.get('index.php/cheque_book/get_cheque_books').then(
                    function(response) {
                  self.cheque_books = response.data;                  
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              var fetch_banks = function() {
                return $http.get('index.php/bank/get_banks').then(
                    function(response) {
                  self.banks = response.data;                  
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              var fetch_partys = function() {
                return $http.get('index.php/party/get_partys').then(
                    function(response) {
                  self.partys = response.data;                  
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              /*
              var fetchgroups = function(){
                return $http.get('index.php/cheque_book/get_cheque_book_groups').then(
                    function(response){
                        self.cheque_book_groups = response.data;
                    },function(errResponse){
                        console.error(errResponse.data.msg);
                    }
              )};
              fetchgroups(); */
              fetch_banks();
              fetch_partys();
              fetchcheque_books();
              
              self.add = function() {
                $http.post('index.php/cheque_book/add_cheque_book', self.newCheque_book)
                    .then(fetchcheque_books)
                    .then(function(response) {
                      self.newCheque_book = {};
                    });
              };
              
            }]);
        </script>
    </div>
    </div>

