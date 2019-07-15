<template>
    <div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Active Tests</div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">Certification ID</th>
                            <th class="text-center">Certification Name</th>
                            <th class="text-center">Topics Covered</th>
                            <th class="text-center">Time Limit</th>
                            <th class="text-center">Activation Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody id="active-tests-table">
                        <tr v-if="activations.length==0"><td colspan="6">No Data</td></tr>
                        <tr v-for="activation in activations">
                            <td class="text-center">{{activation.element.certificationCode}}</td>
                            <td class="text-center">{{activation.element.certificationName}}</td>
                            <td class="text-center"><div v-for="topic in activation.topics">
                                <b>{{topic.code+': '+topic.name}}</b><br>{{topic.list}}
                            </div></td>
                            <td class="text-center">{{activation.element.totalTime + ' Min'}}</td>
                            <td class="text-center">{{activation.element.activationDate}}</td>
                            <td class="text-center">
                                <button class="btn btn-secondary" @click="opentest(activation.element.activationID)">Start Examination</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    </div>
</template>

<script>
    export default {
        name: "AttemptTest",
        data(){
            return{
                activations:[]
            }
        },
        methods:
            {
              opentest(activationID)
              {
                  var opn=window.open("/attemptTest/"+activationID,"_blank", "toolbar=no,scrollbars=yes,resizable=no,fullscreen=yes,channelmode=yes,directories=no,menubar=no,status=no,titlebar=no");
                  opn.opener.document.write("<p>You engaged your session by starting an examination</p>");
              }
            },
        mounted() {
            axios({
                method:'get',
                url:'/api/fetch/allActive'
            }).then(response=>{
                response.data.forEach((element,index)=>{
                    axios({
                              method:'get',
                              url:'/api/fetch/certification/'+element.activationID+'/subjects/topics/'
                          }).then(res=>{
                        this.$data.activations.push({
                            element,topics:res.data
                        })
                          })
                })
            });
            console.log(this.$data.activations);
        }
    }
</script>

<style scoped>

</style>
