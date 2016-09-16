<?php
?>
<div ng-app ="partysApp" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div ng-controller ="PartyCtrl as partyCtrl">
        <form class="form-inline" ng-submit="partyCtrl.add()" name="addParty">            
            <div class="form-group">
              <label for="exampleInputName2">Party Name</label>
              <input type="text" class="form-control" ng-model="partyCtrl.newParty.party_name" required/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Gender</label>
              <label>
              <input type="radio" class="form-control" ng-model="partyCtrl.newParty.gender" value="Male">
              Male
              </label>
              <label>
              <input type="radio" class="form-control" ng-model="partyCtrl.newParty.gender" value="Female">
              Female
              </label>
              <label>
              <input type="radio" class="form-control" ng-model="partyCtrl.newParty.gender" value="Other">
              Other
              </label>
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Party Type</label>
              <select class="form-control" ng-model="partyCtrl.newParty.party_id" 
                  ng-options="party.party_id as party.party_name for party in partyCtrl.partys">                          
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail2">Address</label>
              <input type="text" class="form-control" ng-model="partyCtrl.newParty.address">              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Place</label>
              <input type="text" class="form-control" ng-model="partyCtrl.newParty.place" required/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">District</label>
              <select class="form-control" ng-model="partyCtrl.newParty.instrument_type_id" 
                  ng-options="instrument_type.instrument_type_id as instrument_type.instrument_type for instrument_type in partyCtrl.instrument_types">                          
              </select>
            </div>            
            <div class="form-group">
              <label for="exampleInputName2">Phone</label>
              <input type="text" class="form-control" ng-model="partyCtrl.newParty.phone"/>              
            </div>            
            <div class="form-group">
              <label for="exampleInputEmail2">Alt Phone</label>
              <input type="text" class="form-control" ng-model="partyCtrl.newParty.alt_phone">              
            </div>
            <div class="form-group">
              <label for="exampleInputEmail2">Email</label>
              <input type="email" class="form-control" ng-model="partyCtrl.newParty.email">              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Notes</label>
              <input type="text" class="form-control" ng-model="partyCtrl.newParty.note"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Project</label>
              <select class="form-control" ng-model="partyCtrl.newParty.project_id" 
                  ng-options="project.project_id as project.project_name for project in partyCtrl.projects">                          
              </select>
            </div>
            <input type="submit" class="btn btn-default" value="Add" ng-disabled="addParty.$invalid">
        </form>    
        
        <h3>Partys Added</h3>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Party ID</th>
                    <th>Party Name</th>
                    <th>Gender</th>
                    <th>Party Type</th>
                    <th>Address</th>
                    <th>Place</th>
                    <th>District</th>
                    <th>Phone</th>
                    <th>Alt Phone</th>
                    <th>Email</th>
                    <th>Notes</th>
                    <th>Project</th>                    
                </tr>
            </thead>
            <tr class="success" ng-repeat="party in partyCtrl.partys">
                <td ng-bind="party.party_id"></td>
                <td ng-bind="party.party_name"></td>
                <td ng-bind="party.gender"></td>
                <td ng-bind="party.party_type_id"></td>
                <td ng-bind="party.address"></td>
                <td ng-bind="party.place"></td>
                <td ng-bind="party.district_id"></td>
                <td ng-bind="party.phone"></td>
                <td ng-bind="party.alt_phone"></td>
                <td ng-bind="party.email"></td>
                <td ng-bind="party.note"></td>                
                <td ng-bind="party.project_id"></td>                
            </tr>
            <tr class="active">
                <td>{{ partyCtrl.newParty.party_id }}</td>
                <td>{{ partyCtrl.newParty.party_name }}</td>
                <td>{{ partyCtrl.newParty.gender }}</td>
                <td>{{ partyCtrl.newParty.party_type_id }}</td>
                <td>{{ partyCtrl.newParty.address }}</td>
                <td>{{ partyCtrl.newParty.place }}</td>
                <td>{{ partyCtrl.newParty.district_id }}</td>
                <td>{{ partyCtrl.newParty.phone }}</td>
                <td>{{ partyCtrl.newParty.alt_phone }}</td>
                <td>{{ partyCtrl.newParty.email }}</td>
                <td>{{ partyCtrl.newParty.note }}</td>                
                <td>{{ partyCtrl.newParty.project_id }}</td>                
            </tr>
        </table>
        
        <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.js"></script>
        <script>
          angular.module('partysApp', [])
            .controller('PartyCtrl', ['$http', function($http) {
              var self = this;
              self.partys = [];
              self.banks = [];
              self.projects = [];
              self.instrument_types = [];              
              self.partys = [];
              self.cheque_leaves = [];
              self.newParty = {};
              
              var fetch_partys = function() {
                return $http.get('index.php/party/get_party').then(
                    function(response) {
                  self.partys = response.data;
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
              
              fetch_projects();
              fetch_partys();             
              
              
              self.add = function() {
                $http.post('index.php/party/add_party', self.newParty)
                    .then(fetch_partys)
                    .then(function(response) {
                      self.newParty = {};
                    });
              };
              
            }]);
        </script>
    </div>
    </div>
