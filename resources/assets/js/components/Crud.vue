 <template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
   
class Errors{
            constructor(){
                this.errors = {};
            }
            get(field){
                if(this.errors[field]){
                    return  this.errors[field][0];
                }
            }
            record(errors){
                this.errors = errors.response.data;
            }
            any(){
                return Object.keys(this.errors).length > 0;
            }
            has(field){
                return this.errors.hasOwnProperty(field);
            }
            clear(field){
                if(field) delete this.errors[field];
                this.errors = {};
            }
            clearAll(){
                this.errors = "";
            }
        }
        /* ------------------------------------------------------------------------------------- LOAD PAGE
         ---------------------------------------------------------------------------------------------------- */
        class LoadPage {
            constructor(urlToLoad) {
                // start upload
                this.startLoading(urlToLoad);
            }
            startLoading(urlToLoad){
                axios.get(urlToLoad)
                        .then(function (res) {
                            window.eventBus.$emit('dataLoaded', res.data);
                        })
                        .catch(function (res) {
                            alert('erro');
                        });
            }
        }
        /* ------------------------------------------------------------------------------------- FLASH MESSAGE
         ---------------------------------------------------------------------------------------------------- */
        class FlashMessage {
            constructor(typeMesage , contentMessage , redirect = null ) {
                // start upload
                this.createMessage(typeMesage , contentMessage , redirect);
            }
            createMessage(typeMesage , contentMessage , redirect){
                setTimeout(() => {
                    // set new data
                    swal({
                            title: 'Congratulations',
                            text: contentMessage,
                            type: typeMesage,
                            confirmButtonText: 'OK'
                    }).then(function () {
                    // redirect if is not null
                    if(redirect != null){
                        window.location = redirect
                    }
                })
            }, 0.800);
            }
        }
        /* ------------------------------------------------------------------------------------- CRUD FORM
         ---------------------------------------------------------------------------------------------------- */
        class CrudForm {
            constructor(data) {
                this.originalData = data;
                for(let field in data){
                    this[field] = data[field];
                }
            }
            reset(){
                for(let field in this.originalData){
                    this[field] = '';
                }
            }
            /*  Set a value to the temp , verify if has this item and update  */
            setFillItem(item , index){
                for(let field in this.originalData){
                    if(field in item){
                        this[field] = item[field];
                    }else{
                        // if is index
                        if(field == 'index'){ this[field] = index; }
                    }
                }
            }
            data(){
                let data = Object.assign({} , this);
                delete data.originalData;
                delete data.errors;
                return data;
            }
        }
        /* ------------------------------------------------------------------------------------- CRUD MODAL
         ---------------------------------------------------------------------------------------------------- */
        class CrudModal{
            constructor(data){
                this.modal = data;
            }
            get(value){
                if(this.modal[value]){
                    return this.modal[value];
                }
            }
            set(data , value){
                this.modal[data] = value;
            }
        }
        /* ------------------------------------------------------------------------------------- DESTROY ITEM
         ---------------------------------------------------------------------------------------------------- */
        class DestroyItem{
            constructor(url , item){
                // start upload
                this.startDelete(url , item);
            }
            // start the upload here
            startDelete(url , item) {
                var output = document.getElementById('output');
                var data = new FormData();
                /* data.append('value[]', JSON.stringify({id: item['id'], index: item['index']})); */
                for (var prop in item) {
                    /*alert(item[prop]['id']); */
                    data.append('value[]', JSON.stringify({id: item[prop]['id'], index: item[prop]['index']}));
                }
                axios.post(url, data)
                        .then(function (res) {
                            window.eventBus.$emit('deleteItem', res.data);
                        })
                        .catch(function (err) {
                            alert('erro');
                        });
            }
        }
        /* ------------------------------------------------------------------------------------- PAGINATION
         ---------------------------------------------------------------------------------------------------- */
        class Pagination{
            constructor(data){
                this.pagination = data;
            }
            get(field){
                if(this.pagination[field]){
                    return this.pagination[field];
                }
            }
            set(field , value){
                this.pagination[field] = value;
            }
            changePage(page) {
                this.set('current_page' , page);
                window.eventBus.$emit('updatePage', page);
            }
            prevPage(){
                this.changePage(this.get('current_page') - 1)
            }
            nextPage(){
                this.changePage(this.get('current_page') + 1);
            }
            isActived() {
                return this.get('current_page');
            }
            loadData(data){
                for(let field in this.pagination){
                    if(field in data){
                        /* this.pagination[field] = data[field]; */
                        this.set(field , data[field] );
                    }
                }
            }
            changePageStatus(action , number){
                let value_page = action == 'add' ? this.get('total') + number : this.get('total') - number;
                this.set('total' , value_page);
                this.changePage(1);
            }
        }
        /* ------------------------------------------------------------------------------------- STORE ITEM
         ---------------------------------------------------------------------------------------------------- */
        class StoreItem{
            constructor(url , fillItem){
                // start upload
                this.startUpload(url , fillItem);
            }
            // start the upload here
            startUpload(url , fillItem) {
                var output = document.getElementById('output');
                var data = new FormData();
                for(let field in fillItem){
                    data.append(field, JSON.stringify(fillItem[field]));
                }
                axios.post(url, data)
                        .then(response => {
                    window.eventBus.$emit('createItem', response.data);
            })
            .catch(error => window.eventBus.$emit('formError', error));
            }
        }
        /* ------------------------------------------------------------------------------------- UPDATE ITEM
          ---------------------------------------------------------------------------------------------------- */
        class UpdateItem{
            constructor(url , fillItem ){
                // start upload
                this.startUpload(url , fillItem );
            }
            // start the upload here
            startUpload(url , fillItem) {
                var output = document.getElementById('output');
                var data = new FormData();
                for(let field in fillItem){
                    data.append(field, JSON.stringify(fillItem[field]));
                }
                axios.post(url, data)
                        .then(response =>  window.eventBus.$emit('updateItem', response.data))
                        .catch(error => window.eventBus.$emit('formError', error.response.data));
            }
        }
        // -----------------------------------------------------------------------------------------------  COMPONENT MODAL
        const Modal = {
            template: `   <transition name="modal">
                                <div class="modal-mask">
                                  <div class="modal-wrapper">
                                    <div :class="modalStyle">
                                    <a class="close-modal" @click="$emit('close')" ></a>
                                      <div class="modal-header">
                                           <p class="modal-card-title"><slot name="header" class="modal-card-title "></slot></p>
                                      </div>
                                        <slot name="body">
                                          default body
                                        </slot>
                                    </div>
                                  </div>
                                </div>
                              </transition>` ,
            props: {
                modalsize: {type: String},
            } ,
            computed: {
                modalStyle() {
                    return this.modalsize == null ? 'modal-container' : this.modalsize + ' modal-container';
                }
            }
        };
        window.axios = axios;
        window.eventBus = new Vue();
        // Vue.component('modal', Modal);
            // -----------------------------------------------------------------------------------------------  CRUD
            /*  add components */
            Vue.component('modal', Modal);
            new Vue({
                el: '.display-page',
                data: {
                    pageInfo: {pageUrl: 'vue-crud'} ,
                    forms:new CrudForm({index:'',  id:'' , title:'' , sub_title:'' , description:''  }) ,
                    modal:new CrudModal({create:false , edit:false , delete:false }),
                    pagination: new Pagination({total: 0, per_page: 2, from: 1,to: 0, current_page: 1 , last_page: 1, offset: 4}),
                    formErrors:{},
                    displayItems:[] ,
                    selectedItems:[] ,
                    submitSelectedItems:[] ,
                    errors: new Errors() ,
                    filter: ''
                },
                mounted: function () {
                        this.pagination.set('per_page' , 5);
                        this.loadPage(this.pagination.pagination.current_page);
             } ,
        filters: {
            uppercase: function(value, onlyFirstCharacter) {
                if (!value) {
                    return '';
                }
                value = value.toString();
                if (onlyFirstCharacter) {
                    return value.charAt(0).toUpperCase() + value.slice(1);
                } else {
                    return value.toUpperCase();
                }
            }
        } ,
        methods: {
            editLink(id){
                return this.pageInfo.pageUrl + '/' + id + '/edit';
            } ,
            loadPage: function (page) {
                new LoadPage(this.pageInfo.pageUrl + '/load-display?page=' + page);
            } ,
            link_to(page , value_page ){
                return  this.pageInfo.pageUrl +  '/' + page + '/' + value_page;
            } ,
            createItem() {
                this.forms.reset();
                this.errors.clearAll();
                this.modal.set('create', true);
            } ,
            storeItem() {
                let data =  this.forms.data();
                return  new StoreItem(this.pageInfo.pageUrl + '/store' , data );
            } ,
            editItem(item ,index = this.displayItems.indexOf(item)){
                this.forms.setFillItem(item , index );
                this.errors.clearAll();
                this.modal.set('edit', true);
            } ,
            updateItem() {
                let data  =  this.forms.data();
                return  new UpdateItem(this.pageInfo.pageUrl + '/update' , data);
            } ,
            deleteItem(item , index = this.displayItems.indexOf(item)){
                /*this.setFillItem(item , index); */
                this.submitSelectedItems = [{index: index, id:item.id}];
                this.modal.set('delete', true);
            } ,
            deleteManyItems(){
                let deleteItemsInfo = [];
                for (var prop in this.selectedItems) {
                    let  selectedIndex = this.selectedItems[prop];
                    deleteItemsInfo.unshift({ index: selectedIndex, id:this.displayItems[selectedIndex]['id']});
                }
                this.submitSelectedItems = deleteItemsInfo;
                this.modal.set('delete', true);
            } ,
            destroyItem(item){
                return  new DestroyItem(this.pageInfo.pageUrl + '/delete' , item );
            } ,
            setNewValuesDisplay(value){
                for (let prop in value)
                {
                    this.displayItems.unshift(value[prop]);
                }
            } ,
            setNewItemDisplay(fillItem){
                for (var prop in fillItem) {
                    this.displayItems[fillItem.index][prop]        =     fillItem[prop];
                }
            } ,
            selectAll(){
                var selectall = this.toggleAll;
                if (!selectall) {
                    this.selectedItems = [];
                    for (var prop in this.displayItems) {
                        this.selectedItems.push(prop);
                    }
                }else{
                    this.selectedItems = [];
                }
            } ,
            countAggregate(value){
                if(typeof value != "undefined" && value != null && value.length > 0){
                    return value[0]['aggregate'];
                }
                return 0;
            } ,
            makeThumbExtension(image){
                let thumbImage = (image).split('.');
                return  thumbImage[0] + '_thumb.' + thumbImage[1];
            }
        } ,  computed: {
            pagesNumber(){
                if (!this.pagination.get('to')) {
                    return [];
                }
                var from = this.pagination.get('current_page') - this.pagination.get('offset');
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.pagination.get('offset') * 2);
                if (to >= this.pagination.get('last_page')) {
                    to = this.pagination.get('last_page');
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            } ,
            toggleAll() {
                return this.selectedItems.length == this.displayItems.length
            }
        } ,
        created(){
            eventBus.$on('formDataLoaded' , (item) => {
                        this.formOptions.setFillItem(item);
                });
                    window.eventBus.$on('dataLoaded',  (item) => {
                    this.displayItems = item.data.data;
                    this.pagination.loadData(item.pagination);
                });
                    window.eventBus.$on('createItem' ,  (item) => {
                        // hide modal
                        this.modal.set('create', false);
                    // get all fields dinamic from request
                    this.setNewValuesDisplay(item);
                    /* this.pagination.changePageStatus('add' , 1); */
                    new FlashMessage('success' , 'Item Created');
                });
                    window.eventBus.$on('statusModal' , (item) => {
                        this[item.modal] = item.status;
                });
                    window.eventBus.$on('updatePage' , (page) => {
                        this.loadPage(page);
                });
                    window.eventBus.$on('updateItem' , (data) => {
                        // set new value item
                        /* this.setNewItemDisplay(data); */
                        for (var prop in data) {
                        this.displayItems[data.index][prop]        =     data[prop];
                    }
                    // hide modal
                    this.modal.set('edit', false);
                });
                    window.eventBus.$on('deleteItem' , (data) => {
                        let count = 0;
                    for (var prop in data.index)
                    {
                        this.displayItems.splice(data.index[prop], 1);
                        count ++;
                    }
                    // set pagination
                    this.pagination.changePageStatus('remove' , count);
                    this.selectedItems = [];
                    this.submitSelectedItems = [];
                    // hide modal
                    this.modal.set('delete', false);
                });
                    window.eventBus.$on('formError' , (data) => {
                        this.errors.record(data);
                        console.log(this.errors);
                        console.log(this.errors.get('title'));
                });
        }
            });

</script>