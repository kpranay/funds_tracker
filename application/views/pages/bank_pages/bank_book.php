<?php
?>
<div ng-app ="bank_booksApp" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div ng-controller ="Bank_bookCtrl as bank_bookCtrl">
        <form class="form-inline" ng-submit="bank_bookCtrl.add()" name="addBank_book">            
            <div class="form-group">
              <label for="exampleInputName2">Account Name</label>
              <label>{{bank_bookCtrl.bank_accounts.account_name}}</label>
              <input type="hidden" class="form-control" ng-model="bank_bookCtrl.newBank_book.bank_account_id" value="{{bank_bookCtrl.bank_accounts.account_id}}" placeholder="{{bank_bookCtrl.bank_accounts.account_name}}" required readonly/>                           
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Transaction Type:</label>
              <label>
              <input type="radio" class="form-control" ng-model="bank_bookCtrl.newBank_book.debit_credit" value="Credit">
              Credit
              </label>
              <label>
              <input type="radio" class="form-control" ng-model="bank_bookCtrl.newBank_book.debit_credit" value="Debit">
              Debit
              </label>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail2">Transaction Date</label>
              <input type="date" class="form-control" ng-model="bank_bookCtrl.newBank_book.date">              
            </div>  
            <div class="form-group">
              <label for="exampleInputName2">Party Name</label>
              <select class="form-control" ng-model="bank_bookCtrl.newBank_book.party_id" 
                  ng-options="party.party_id as party.party_name for party in bank_bookCtrl.partys">                          
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Narration</label>
              <input type="text" class="form-control" ng-model="bank_bookCtrl.newBank_book.narration" required/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Instrument Type</label>
              <select class="form-control" ng-model="bank_bookCtrl.newBank_book.instrument_type_id" 
                  ng-options="instrument_type.instrument_type_id as instrument_type.instrument_type for instrument_type in bank_bookCtrl.instrument_types">                          
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Instrument ID</label>
              <select class="form-control" ng-model="bank_bookCtrl.newBank_book.instrument_type_id" 
                  ng-options="instrument_type.cheque_leaf_number as cheque_leaf.cheque_leaf_number for cheque_leaf in bank_bookCtrl.cheque_leaves">                          
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Instrument Date</label>
              <input type="date" class="form-control" ng-model="bank_bookCtrl.newBank_book.instrument_date">
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Bank</label>
              <select class="form-control" ng-model="bank_accountCtrl.newBank_book.bank_id" 
                  ng-options="bank.bank_id as bank.bank_name for bank in bank_bookCtrl.banks">                          
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Transaction Amount</label>
              <input type="text" class="form-control" ng-model="bank_bookCtrl.newBank_book.transaction_amount"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Clearance Status</label>
              <label>
              <input type="radio" class="form-control" ng-model="bank_bookCtrl.newBank_book.clearance_status" value="Yes">
              Yes
              </label>
              <label>
              <input type="radio" class="form-control" ng-model="bank_bookCtrl.newBank_book.clearance_status" value="No">
              No
              </label>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail2">Clearance Date</label>
              <input type="date" class="form-control" ng-model="bank_bookCtrl.newBank_book.clearance_date">              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Bill Recieved</label>
              <label>
              <input type="radio" class="form-control" ng-model="bank_bookCtrl.newBank_book.bill_recieved" value="Yes">
              Yes
              </label>
              <label>
              <input type="radio" class="form-control" ng-model="bank_bookCtrl.newBank_book.bill_recieved" value="No">
              No
              </label>
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Notes</label>
              <input type="text" class="form-control" ng-model="bank_bookCtrl.newBank_book.notes"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Project</label>
              <select class="form-control" ng-model="bank_bookCtrl.newBank_book.project_id" 
                  ng-options="project.party_id as project.party_name for project in bank_bookCtrl.projects">                          
              </select>
            </div>
            <input type="submit" class="btn btn-default" value="Add" ng-disabled="addBank_book.$invalid">
        </form>    
        
        <h3>Bank_books Added</h3>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Transaction Type</th>
                    <th>Transaction Date</th>
                    <th>Party Name</th>
                    <th>Narration</th>
                    <th>Instrument Type</th>
                    <th>Instrument ID</th>
                    <th>Instrument Date</th>
                    <th>Bank Name</th>
                    <th>Transaction Amount</th>
                    <th>Clearance Status</th>
                    <th>Clearance Date</th>
                    <th>Bill Recieved</th>
                    <th>Notes</th>
                    <th>Project Name</th>
                </tr>
            </thead>
            <tr class="success" ng-repeat="bank_book in bank_bookCtrl.bank_books">
                <td ng-bind="bank_book.bank_account_id"></td>
                <td ng-bind="bank_book.transaction_id"></td>
                <td ng-bind="bank_book.account_id"></td>
                <td ng-bind="bank_book.debit_credit"></td>
                <td ng-bind="bank_book.date"></td>
                <td ng-bind="bank_book.party_id"></td>
                <td ng-bind="bank_book.narration"></td>
                <td ng-bind="bank_book.instrument_type_id"></td>
                <td ng-bind="bank_book.instrument_id"></td>
                <td ng-bind="bank_book.instrument_date"></td>
                <td ng-bind="bank_book.bank_id"></td>
                <td ng-bind="bank_book.transaction_amount"></td>
                <td ng-bind="bank_book.clearance_status"></td>
                <td ng-bind="bank_book.clearance_date"></td>
                <td ng-bind="bank_book.bill_recieved"></td>
                <td ng-bind="bank_book.notes"></td>
                <td ng-bind="bank_book.project_id"></td>          
            </tr>
            <tr class="active">
                <td>{{ bank_bookCtrl.newBank_book.bank_account_id }}</td>
                <td>{{ bank_bookCtrl.newBank_book.transaction_id }}</td>
                <td>{{ bank_bookCtrl.newBank_book.account_id }}</td>
                <td>{{ bank_bookCtrl.newBank_book.debit_credit }}</td>
                <td>{{ bank_bookCtrl.newBank_book.date }}</td>
                <td>{{ bank_bookCtrl.newBank_book.party_id }}</td>
                <td>{{ bank_bookCtrl.newBank_book.narration }}</td>
                <td>{{ bank_bookCtrl.newBank_book.instrument_type_id }}</td>
                <td>{{ bank_bookCtrl.newBank_book.instrument_id }}</td>
                <td>{{ bank_bookCtrl.newBank_book.instrument_date }}</td>
                <td>{{ bank_bookCtrl.newBank_book.bank_id }}</td>
                <td>{{ bank_bookCtrl.newBank_book.transaction_amount }}</td>
                <td>{{ bank_bookCtrl.newBank_book.clearance_status }}</td>
                <td>{{ bank_bookCtrl.newBank_book.clearance_date }}</td>
                <td>{{ bank_bookCtrl.newBank_book.bill_recieved }}</td>
                <td>{{ bank_bookCtrl.newBank_book.notes }}</td>
                <td>{{ bank_bookCtrl.newBank_book.project_id }}</td>     
            </tr>
        </table>
        
        <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.js"></script>
        <script>
          angular.module('bank_booksApp', [])
            .controller('Bank_bookCtrl', ['$http', function($http) {
              var self = this;
              self.bank_accounts = [];
              self.bank_books = [];
              self.banks = [];
              self.projects = [];
              self.instrument_types = [];              
              self.partys = [];
              self.cheque_leaves = [];
              self.newBank_book = {};
              var fetchbank_books = function() {
                return $http.get('index.php/bank_book/get_bank_books').then(
                    function(response) {
                  self.bank_books = response.data;                  
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
              var fetch_projects = function() {
                return $http.get('index.php/project/get_projects').then(
                    function(response) {
                  self.projects = response.data;                  
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              var fetch_partys = function() {
                return $http.get('index.php/party/get_party').then(
                    function(response) {
                  self.partys = response.data;
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              var fetch_instrument_types = function() {
                return $http.get('index.php/instrument_type/get_instrument_type').then(
                    function(response) {
                  self.instrument_types = response.data;
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              var fetch_cheque_leaves = function() {
                return $http.get('index.php/cheque_leaves/get_cheque_leaves').then(
                    function(response) {
                  self.cheque_leaves = response.data;
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              var fetchbank_accounts = function() {
                return $http.get('index.php/bank_account/get_bank_accounts').then(
                    function(response) {
                  self.bank_accounts = response.data;                  
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              
              fetchbank_accounts();
              fetch_banks();
              fetch_projects();
              fetch_partys();
              fetch_instrument_types();
              fetch_cheque_leaves();
              fetchbank_books();
              
              self.add = function() {
                $http.post('index.php/bank_book/add_bank_book', self.newBank_book)
                    .then(fetchbank_books)
                    .then(function(response) {
                      self.newBank_book = {};
                    });
              };
              
            }]);
        </script>
    </div>
    </div>
