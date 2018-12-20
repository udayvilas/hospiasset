app.factory('baseFactory', function($http,$log,$q) {
return {
    Mainadmin: function(input_data)
   {
       var deferred = $q.defer();
       $http.post('mainadmin',input_data,
           {
               headers: {'Accept': 'application/json','Content-Type': 'application/json'}
           })
           .success(function(data)
           {
               deferred.resolve(data)
           })
           .error(function(msg, code)
           {
               deferred.reject(msg);
               $log.error(msg, code);
           });
       return deferred.promise;
    }, 
    getVendors : function(input_data)
    {
         var deferred = $q.defer();
         $http.post('mainadmin/getvendors',input_data)
         .success(function(data)
         {
              deferred.resolve(data);
         })
         .error(function(msg, code)
         {
              deferred.reject(msg);
              $log.error(msg, code);
         });
         return deferred.promise;
    },
  
   getassignvendornames : function(str)
    {
        var url = "basectrl/get_assign_vendor_list/"+str;
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    if (response.data.response == "success")
                    {

                        return response.data.vendornames;
                    }
                    else
                    {
                        response.data.vendornames = [];
                        return response.data.vendornames;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.vendornames);
                });
        }
    },
  
  
  getdistributerlist : function(str)
    {
        var url = "basectrl/getdistributerlist/"+str;
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    if (response.data.response == "success")
                    {

                        return response.data.vendornames1;
                    }
                    else
                    {
                        response.data.vendornames1 = [];
                        return response.data.vendornames1;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.vendornames1);
                });
        }
    },
  
  
  getassignusernames : function(str)
    {
        var url = "basectrl/get_assign_user_list/"+str;
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    if (response.data.response == "success")
                    {

                        return response.data.usernames;
                    }
                    else
                    {
                        response.data.usernames = [];
                        return response.data.usernames;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.usernames);
                });
        }
    },
    UserCtrl : function (input_data)
    {
        var deferred = $q.defer();
        $http.post('user',input_data,
        {
            headers: {'Accept': 'application/json','Content-Type': 'application/json'}
        })
        .success(function(data)
        {
          deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
       return deferred.promise;
    },

    getBranchUsers : function (input_data)
    {
       var deferred = $q.defer();
        $http.post('hmadmin/getBranchUsers',input_data)
        .success(function(data)
        {
          deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
       return deferred.promise;
    },

    getContractTypes:function(input_data)
    {
      var deferred = $q.defer();
        $http.post('basectrl/loadContractsTypes',input_data)
        .success(function(data)
        {
          deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
       return deferred.promise;
    },

    getPmsDetails:function(input_data)
    {
      var deferred = $q.defer();
        $http.post('basectrl/loadPmsDetails',input_data)
        .success(function(data)
        {
          deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
       return deferred.promise;
    },
    getTraningDetails:function(input_data)
    {
      var deferred = $q.defer();
        $http.post('basectrl/loadTrainingTypes',input_data)
        .success(function(data)
        {
          deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
       return deferred.promise;
    },

    getQcsDetails:function(input_data)
    {
      var deferred = $q.defer();
        $http.post('basectrl/loadPmsDetails',input_data)
        .success(function(data)
        {
          deferred.resolve(data)
        })

        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
       return deferred.promise;
    },

    getDepartments:function(input_data)
    {
      var deferred = $q.defer();
        $http.post('basectrl',input_data,
        {
            headers: {'Accept': 'application/json','Content-Type': 'application/json'}
        })
        .success(function(data)
        {
          deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
       return deferred.promise;
    },

    getStatus:function(input_data)
    {
      var deferred = $q.defer();
        $http.post('basectrl/loadStatus',input_data)
        .success(function(data)
        {
          deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
       return deferred.promise;
    },

    getUtilizations:function(input_data)
    {
    var deferred = $q.defer();
      $http.post('basectrl/loadUtillization',input_data)
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

    getEupConditions:function(input_data)
    {
    var deferred = $q.defer();
      $http.post('basectrl/loadEupConditions',input_data)
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

   addDevice:function(input_data)
   {
     var deferred = $q.defer();
      $http.post('device',input_data,
      {
          headers: {'Accept': 'application/json','Content-Type': 'application/json'}
      })
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

   uploadFileToUrl:function(file,uploadUrl)
   {
      var fd = new FormData();
      fd.append('assetlist', file);
      var deferred = $q.defer();
      $http.post(uploadUrl, fd, {
          transformRequest: angular.identity,
          headers: {'Content-Type': undefined}
       })
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

   addDeviceFileUpload:function(data,files,uploadUrl)
   {
       var fd = new FormData();
       console.log(files);
       for(var i=0;i<files.length;i++)
       {
           $log.debug(files[i]);
           $log.debug(files[i]._file);
           fd.append(i, files[i]._file);
       }
       data.flength = files.length;
      fd.append('device_data', angular.toJson(data));
      console.log("elememt "+JSON.stringify(data));


      var deferred = $q.defer();
      $http.post(uploadUrl, fd,
      {
          transformRequest: angular.identity,
          headers: {'Content-Type': undefined}
      })
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

   addDeviceFileUpload1:function(data,files,uploadUrl)
   {
       var fd = new FormData();
       console.log(files);
       for(var i=0;i<files.length;i++)
       {
           $log.debug(files[i]);
           //$log.debug(files[i]._file);
           fd.append(files[i].name1, files[i]._file);
       }
       data.flength = files.length;
      fd.append('device_data', angular.toJson(data));
      var deferred = $q.defer();
      $http.post(uploadUrl, fd,
      {
          transformRequest: angular.identity,
          headers: {'Content-Type': undefined}
      })
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },
    addQCFileUpload:function(data,files,uploadUrl)
    {
        var fd = new FormData();
        console.log(files);
        for(var i=0;i<files.length;i++)
        {
            $log.debug(files[i]);
            //$log.debug(files[i]._file);
            fd.append(i, files[i]._file);
        }
        //data.flength = files.length;
        var send_data = {values:data};
        fd.append('data', angular.toJson(send_data));
        var deferred = $q.defer();
        $http.post(uploadUrl, fd,
            {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            })
            .success(function(data)
            {				console.log("deferred:",data);
                deferred.resolve(data)
            })
            .error(function(msg, code)
            {
                deferred.reject(msg);
                $log.error(msg, code);
            });
        return deferred.promise;
    },
	
	addRoundFileUpload:function(data,files,uploadUrl)
    {
        var fd = new FormData();
        fd.append('files', files);
        var send_data = {values:data};
        fd.append('data', angular.toJson(send_data));
         var deferred = $q.defer();
        $http.post(uploadUrl, fd, {
        transformRequest: angular.identity,
        headers: {'Content-Type': undefined}
    })

        .success(function(){
            console.log("deferred:",files);
            deferred.resolve(data);
        })

        .error(function(msg, code){
            deferred.reject(msg);
            $log.error(msg,code);
        });

        return deferred.promise;
    },
    
    
    addRoundFileUpload3:function(hospital,files,uploadUrl)
    {
        var fd = new FormData();
        fd.append('files', files);
        var send_data = {values:hospital};
        fd.append('hospital', angular.toJson(send_data));
         var deferred = $q.defer();
        $http.post(uploadUrl, fd, {
        transformRequest: angular.identity,
        headers: {'Content-Type': undefined}
    })

        .success(function(){
            console.log("deferred:",files);
            deferred.resolve(hospital);
        })

        .error(function(msg, code){
            deferred.reject(msg);
            $log.error(msg,code);
        });

        return deferred.promise;
    },

    addPMSFileUpload:function(data,files,uploadUrl)
    {
        var fd=new FormData();
        console.log(files);
        for(var i=0;i<files.length;i++)
        {
            $log.debug(files[i]);
            fd.append(i,files[i]._file);
        }
        data.flength=files.length;
        fd.append('pms_data',angular.toJson(data));
        var deferred=$q.defer();
        $http.post(uploadUrl,fd,{
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
        })
        .success(function(data)
        {
            deferred.resolve(data);
        })
        .error(function(msg,code){
            deferred.reject(msg);
            $log.error(msg,code);
        })
        return deferred.promise;
    },
   searchEquipment:function(input_data)
   {
       $log.debug(input_data);
    var deferred = $q.defer();
      $http.post('device',input_data,
      {
          headers: {'Accept': 'application/json','Content-Type': 'application/json'}
      })
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

   getEqupDept:function(input_data)
   {
    var deferred = $q.defer();
      $http.post('basectrl/getEqupDept',input_data)
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

   getEqupDeptSumry:function(input_data)
   {
    var deferred = $q.defer();
      $http.post('device',input_data,
      {
          headers: {'Accept': 'application/json','Content-Type': 'application/json'}
      })
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

    getEqupUnitWise:function(input_data)
   {
   	var deferred = $q.defer();
      $http.post('device',input_data,
          {
             headers: {'Accept': 'application/json','Content-Type': 'application/json'}
          })
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

   PrintLables:function(input_data)
   {
    var deferred = $q.defer();
      $http.post('device',input_data,
      {
          headers: {'Accept': 'application/json','Content-Type': 'application/json'}
      })
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

   wordPrintLables:function(input_data)
   {
      var deferred = $q.defer();
      $http.post('device/word_print_lables',input_data)
      .success(function(data)
      {
        deferred.resolve(data);
      })
      .error(function(msg,code)
      {
        deferred.reject(msg);
        $log.error(msg, code);
      });
      return deferred.promise;
   },

   getDevices:function(input_data)
   {
     var deferred = $q.defer();
      $http.post('device',input_data,
      {
          headers: {'Accept': 'application/json','Content-Type': 'application/json'}
      })
      .success(function(data)
      {
        deferred.resolve(data)
      })
      .error(function(msg, code)
      {
          deferred.reject(msg);
          $log.error(msg, code);
      });
     return deferred.promise;
   },

    searchDeviceCG:function(input_data)
    {
        var deferred = $q.defer();
        input_data.action = "device_search_cg";
        $http.post('device',input_data,
        {
            headers: {'Accept': 'application/json','Content-Type': 'application/json'}
        })
        .success(function(data)
        {
            deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
    return deferred.promise;
    },

    getDeviceReasons:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('device',input_data,
        {
            headers: {'Accept': 'application/json','Content-Type': 'application/json'}
        })
        .success(function(data)
        {
            deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
    return deferred.promise;
    },
    getDevicePriorities:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('device',input_data,
        {
            headers: {'Accept': 'application/json','Content-Type': 'application/json'}
        })
        .success(function(data)
        {
            deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
    return deferred.promise;
    },

    GenerateCallByUser:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('device',input_data,
            {
                headers: {'Accept': 'application/json','Content-Type': 'application/json'}
            })
            .success(function(data)
            {
                deferred.resolve(data)
            })
            .error(function(msg, code)
            {
                deferred.reject(msg);
                $log.error(msg, code);
            });
        return deferred.promise;
    },
    getHodBmes:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('basectrl',input_data,
        {
            headers: {'Accept': 'application/json','Content-Type': 'application/json'}
        })
        .success(function(data)
        {
            deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
    return deferred.promise;
    },
    deviceCall:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('device',input_data,
        {
            headers: {'Accept': 'application/json','Content-Type': 'application/json'}
        })
        .success(function(data)
        {
            deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
    return deferred.promise;
    },
    reportsCall:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('reports',input_data,
            {
                headers: {'Accept': 'application/json','Content-Type': 'application/json'}
            })
            .success(function(data)
            {
                deferred.resolve(data)
            })
            .error(function(msg, code)
            {
                deferred.reject(msg);
                $log.error(msg, code);
            });
        return deferred.promise;
    },
    graphsCall:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('graphs',input_data,
            {
                headers: {'Accept': 'application/json','Content-Type': 'application/json'}
            })
            .success(function(data)
            {
                deferred.resolve(data)
            })
            .error(function(msg, code)
            {
                deferred.reject(msg);
                $log.error(msg, code);
            });
        return deferred.promise;
    },
    baseCall:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('basectrl',input_data,
        {
            headers: {'Accept': 'application/json','Content-Type': 'application/json'}
        })
        .success(function(data)
        {
            deferred.resolve(data)
        })
        .error(function(msg, code)
        {
            deferred.reject(msg);
            $log.error(msg, code);
        });
    return deferred.promise;
    },

    GetCityNames:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('user/loadCities',input_data)
            .success(function(data)
            {
                deferred.resolve(data)
            })
            .error(function(msg, code)
            {
                deferred.reject(msg);
                $log.error(msg, code);
            });
        return deferred.promise;
    },
	authCtrl:function(input_data)
    {
        var deferred = $q.defer();
        $http.post('auth',input_data,
			{
				headers: {'Accept': 'application/json','Content-Type': 'application/json'}
			})
            .success(function(data)
            {
                deferred.resolve(data)
            })
            .error(function(msg, code)
            {
                deferred.reject(msg);
                $log.error(msg, code);
            });
        return deferred.promise;
    },
    getEquipment: function(str,dept,branch_id,user_id,org_id)
    {
        str = (str == '') ? 'ABCD' : str;
        dept = (dept == '') ? 'ABCD' : dept;
        var url = "basectrl/geteids/"+str+"/"+dept+"/"+branch_id+"/"+user_id+"/"+org_id;
        console.log(url);
        if(str=="" || str=='undefined' )
        {
            return [];
        }
        else
        {
            return $http.get(url)
            .then(function(response)
            {
                console.log(response);
                if (response.data.response == "success")
                {
                    console.log(response);
                    return response.data.eids;
                }
                else
                {
                   // console.log("false");
                    response.data.eids = [];
                    return response.data.eids;
                }
            }, function(response) {
                // something went wrong
                return $q.reject(response.data.eids);
            });
        }
    },
    getVendorNames : function(str)
    {
        var url = "basectrl/getvnames/"+str;
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
            .then(function(response)
            {
                if (response.data.response == "success")
                {

                    return response.data.vnames;
                }
                else
                {
                    response.data.vnames = [];
                    return response.data.vnames;
                }
            }, function(response) {
                // something went wrong
                return $q.reject(response.data.vnames);
            });
        }
    },

    getContactPersonName : function(str)
    {
        var url = "basectrl/getcpnames/"+str;
		console.log(url);
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
			.then(function(response)
			{
				if (response.data.response == "success")
				{
					return response.data.cpnames;
				}
				else
				{
					response.data.cpnames = [];
					return response.data.cpnames;
				}
			}, function(response) {
				// something went wrong
				return $q.reject(response.data.cpnames);
			});
        }
    },
	getequipmentcategory :function(str){

        var url = "basectrl/getequipmentcat/"+str;
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    //console.log(response);
                    if (response.data.response == "success")
                    {
                        return response.data.ecat;
                    }
                    else
                    {
                        response.data.ecat = [];
                        return response.data.ecat;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.ecat);
                });
        }
    },
	
	
	getorgmastertable :function(str){
		var url = "basectrl/getorg_master_table"+str;
		if(str="" || str=='undefined')
		{
			return [];
		}else
		{
			return $http.get(url)
                .then(function(response)
                {
					//console.log(response);
                    if (response.data.response == "success")
                    {
                        return response.data.code;
                    }
                    else
                    {
                        response.data.cname = [];
                        return response.data.code;
                    }
				},function(response) {
                    // something went wrong
                    return $q.reject(response.data.code);
                });
				
		}
	},
	getcompanynames :function(str){

        var url = "basectrl/getcompanynames/"+str;
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    //console.log(response);
                    if (response.data.response == "success")
                    {
                        return response.data.cname;
                    }
                    else
                    {
                        response.data.cname = [];
                        return response.data.cname;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.cname);
                });
        }
    },
	getEquipmentType : function(str){
        var url = "basectrl/getEquipmentType/"+str;
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    //console.log(response);
                    if (response.data.response == "success")
                    {
                        return response.data.etype;
                    }
                    else
                    {
                        response.data.etype = [];
                        return response.data.etype;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.etype);
                });
        }
    },
	
	getEquipmentbybranch : function(str,branch_id){
        var url = "basectrl/getEquipmentbybranch/"+str+"/"+branch_id;
         console.log(url);
        if(str=="" || str=='undefined' || branch_id =="" || branch_id == 'undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    console.log(JSON.stringify(response));
                    if (response.data.response == "success")
                    {
                        return response.data.eid;
                    }
                    else
                    {
                        response.data.eid = [];
                        return response.data.eid;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.eid);
                });
        }
    },
	getEquipmentbybranch1 : function(str,branch_id,org_id){
        var url = "basectrl/getEquipmentbybranch1/"+str+"/"+branch_id+"/"+org_id;
        console.log(url);
        if(str=="" || str=='undefined' || branch_id =="" || branch_id == 'undefined' || org_id == 'undefined' || org_id =="")
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    console.log(JSON.stringify(response));
                    if (response.data.response == "success")
                    {
                        return response.data.eid;
                    }
                    else
                    {
                        response.data.eid = [];
                        return response.data.eid;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.eid);
                });
        }
    },
	
	getEquipmentbybranchdept : function(str,branch,dept){
        var url = "basectrl/getEquipmentbybranchdept/"+str+"/"+branch+"/"+dept;
         console.log(url);
        if(str=="" || str=='undefined' || branch =="" || branch == 'undefined' || dept == 'undefined' || dept =="")
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    // console.log(JSON.stringify(response));
					
                    if (response.data.response == "success")
                    {
                        return response.data.eid;
                    }
                    else
                    {
                        response.data.eid = [];
                        return response.data.eid;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.eid);
                });
        }
    },
	
	
	

    getSerialno : function(str,branch){
        var url = "basectrl/getSerialnobybranch/"+str+"/"+branch;
        console.log(url);
        if(str=="" || str=='undefined' || branch =="" || branch == 'undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    //console.log(response);
                    if (response.data.response == "success")
                    {
                        return response.data.serial;
                    }
                    else
                    {
                        response.data.serial = [];
                        return response.data.serial;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.serial);
                });
        }
    },
	
	getEquipmentname : function(str)
    {
        var url = "basectrl/getequipmentnames/"+str;
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    //console.log(response);
                    if (response.data.response == "success")
                    {
                        return response.data.department;
                    }
                    else
                    {
                        response.data.department = [];
                        return response.data.department;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.department);
                });
        }
    },
	
	getDepartment : function(str)
    {
       var url = "basectrl/getdepartments/"+str;
        if(str=="" || str=='undefined')
        {
            return [];
        }
        else
        {
            return $http.get(url)
                .then(function(response)
                {
                    //console.log(response);
                    if (response.data.response == "success")
                    {
                        return response.data.department;
                    }
                    else
                    {
                        response.data.department = [];
                        return response.data.department;
                    }
                }, function(response) {
                    // something went wrong
                    return $q.reject(response.data.department);
                });
        }
    }
   
}
});
