<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Email
                <small>Email Templates</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="/"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade " id="add_new_modal">
                        <div
                            class="modal-dialog modal-lg"
                        >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">
                                        Add New Template
                                    </h4>
                                    <button
                                        class="close"
                                        data-dismiss="modal"
                                        type="button"
                                    >
                                        <span>&times</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action=""
                                        method="post"
                                        enctype="multipart/form-data"
                                        @submit.prevent="add()"
                                    >
                                        <div class="form-group row">
                                            <label
                                                for="template_name"
                                                class="control-label col-md-3"
                                                >Template Name:
                                            </label>
                                            <div class="col-md-9">
                                                <input
                                                    type="text"
                                                    name="template_name"
                                                    id="template_name"
                                                    class="form-control"
                                                    :class="errors.template_name? 'validate-error': ''"
                                                    v-model="form.template_name"
                                                />
                                                <span v-if="errors.template_name" class="helo-block text-danger">{{ errors.template_name[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                for="mail_subject"
                                                class="col-md-3 control-label"
                                                >Mail Subject</label
                                            >
                                            <div class="col-md-9">
                                                <input
                                                    type="text"
                                                    name="mail_subject"
                                                    id="mail_subject"
                                                    class="form-control"
                                                    :class="errors.mail_subject? 'validate-error': ''"
                                                    v-model="form.mail_subject"
                                                />
                                                <span v-if="errors.mail_subject" class="helo-block text-danger">{{ errors.mail_subject[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                for="mail_body"
                                                class="col-md-3 control-label"
                                                >Mail Body</label
                                            >
                                            <div class="col-md-9">
                                                <ckeditor :editor="editor" v-model="form.mail_body" :config="editorConfig"></ckeditor>
                                                <span v-if="errors.mail_body" class="helo-block text-danger">{{ errors.mail_body[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                for="attach_file"
                                                class="control-label col-md-3"
                                                >Attachment</label
                                            >
                                            <div class="col-md-9">
                                                <input
                                                    type="file"
                                                    multiple
                                
                                                    id="attach_file"
                                                    @change="attach_file"
                                                />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-9 col offset-md-3">
                                                <button
                                                    class="btn btn-lg btn-outline-success btn-block"
                                                >
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            
                            <!-- <h3 class="box-title">
                                Data Table With Full Features
                            </h3> -->
                            <button
                                class="btn btn-primary"
                                type="button"
                                data-toggle="modal"
                                data-target="#add_new_modal"
                            >
                                Add New Template
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table
                                id="email-formate-table"
                                class="table table-bordered table-striped"
                            >
                                <thead>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td>4</td>
                                        <td>X</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>
<script>
        import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    // import CKEditor from '@ckeditor/ckeditor5-vue';

    export default {
        data(){
            return{
               form: {
                attach_file:"",
                template_name : "",
                mail_subject: "",
                mail_body:""
               },
               errors:{},
               editor: ClassicEditor,
               editorConfig: {
                    toolbar: ['heading','bold', 'italic', '|', 'link','bulletedList', 'numberedList','blockQuote','undo','redo'],
  
                }           
            }
        },
        methods:{
            add(){
                axios.post('/email-template',this.form)
                .then(res=>{
                    console.log(res)
                    this.errors = [];
                    this.form.template_name= "",
                    this.form.mail_subject= "",
                    this.form.mail_body= ""
                }).catch(err=>{
                    this.errors = err.response.data.errors
                })
            }, 
            attach_file(e){
                console.log(e)
                let files = e.targer.files[0]
                this.attach_file = files
            }
        }
        
    };
</script>
