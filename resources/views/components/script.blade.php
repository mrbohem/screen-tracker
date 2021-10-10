<script>
function BroadcastChannel(e){
     data = Livewire.components.getComponentsByName(e.component);
     if(data.length == 1)
     {
          data.forEach(component => {
               if (component.id != e.compId && e.shouldReceive) {
                    Object.keys(e.params).forEach(function (key1) {
                         if(typeof(e.params[key1]) == "object"){
                              if(e.params[key1] != null)
                              {
                                   Object.keys(e.params[key1]).forEach(function (key2) {
                                   component.set(key1+'.'+key2, e.params[key1][key2], 'defer');
                              });
                         }
                    }
                    else{
                         component.set(key1, e.params[key1], 'defer');
                    }
               });
               component.set('shouldBroadcast', false, 'defer');
               e.updates.forEach(el => {
                    if (el.type == "callMethod") {
                         window.livewire.find(component.id)[el.payload.method](...el.payload.params);
                    }
               });
          }
     });
     }
}

Echo.channel('screen_wire').listen('ScreenWireEvent', (e) => {
     console.log("public");
     BroadcastChannel(e);
});

Echo.private('screen_wire_auth_{{Auth::id()}}').listen('ScreenWireAuthEvent',(e)=>{
     console.log("private");
     BroadcastChannel(e);
});
          
          // artisan vendor:publish --force --tag=screen-wire-assets --ansi





     // function isEmptyObject(obj) {
     //      for(var prop in obj) {
     //           if (Object.prototype.hasOwnProperty.call(obj, prop)) {
     //                return false;
     //           }
     //      }
     //      return true;
     // }
     // Echo.channel('screen_wire').listen('ScreenWireEvent', (e) => {
     //      data = Livewire.components.getComponentsByName(e.component);
     //      data.forEach(component => {
     //           if (component.id != e.compId && e.mia == "take") {
     //                Object.keys(e.params).forEach(function (key) {
     //                     component.set(key, e.params[key], 'defer');
     //                });
     //                component.set('shouldBroadcast',false,'defer');
     //                e.updates.forEach(el => {
     //                     if (el.type == "callMethod") {
     //                          window.livewire.find(component.id)[el.payload.method](...el.payload.params);
     //                     }
     //                });
     //           }
     //      });
     // });
     
     // artisan vendor:publish --force --tag=screen-wire-assets --ansi
</script>