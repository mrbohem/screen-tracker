<script>
     function BroadcastChannel(e){
     data = Livewire.components.getComponentsByName(e.component);
     if(data.length == 1)
     {
          data.forEach(component => {
               if (component.id != e.compId && e.shouldReceive) {
                    scrollIntoView(component.el);
                    highlight(component.el);
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

const scrollIntoView = (comp) =>{
     @if(config('screen-tracker.scroll_into_view'))
          comp.scrollIntoView(@json(config('screen-tracker.scroll_into_view')));
     @endif
}

const highlight = (comp) => {
     @if(config('screen-tracker.highlight_color'))
          setTimeout(()=>{
               comp.style.backgroundColor = "{{config('screen-tracker.highlight_color') ?? '#fff2ac' }}";
          },1,comp);
     @endif
};
Echo.channel('screen_tracker').listen('ScreenTrackerEvent', (e) => {
     BroadcastChannel(e);
});

Echo.private('screen_tracker_auth_{{\Hashids::encode(Auth::id())}}').listen('ScreenTrackerAuthEvent',(e)=>{
     BroadcastChannel(e);
});
     
//php artisan vendor:publish --force --tag=screen-tracker-views --ansi
</script>