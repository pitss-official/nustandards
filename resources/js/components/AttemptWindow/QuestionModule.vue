<template>
    <div>
    <div class="row" id="content-window">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Topics and Questions</h4>
                    <div v-for="(topic, index) in topicsAndQuestions">
                        <h6>{{topic.topicName}}</h6>
                        <table class="table browser m-t-20 no-border" :id="'topic-questions-'+index">
                            <tbody>
                            <tr class="callout callout-success bg-white">
                                <td>
                                    <button v-for="(question,qindex) in topic.questions"
                                            class="btn btn-spaced btn-primary"
                                            @click="selectQuestion(index,question.question_marker)" :id="'btn-'+question.question_marker">{{(qindex+1)}}
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5>{{selectedTopic.topicName}}<div class="text-danger pull-right">Time Remaining: {{parseInt(timeLeft/60)}}:{{parseInt(timeLeft%60)}}</div></h5>
                    <hr>
                    <div class="p-3">
                        <h4 class="card-title">{{selectedQuestion.question_text}}</h4>
                        <div v-for="(optionText,optionIndice,answerIndice) in selectedQuestion.options" class="p-lg-1">
                            <input v-if="selectedQuestion.type==0" type="radio" name="option" @click="selectAnswer(selectedQuestion.question_marker,(answerIndice+1))" :value="answerIndice"/>
                            <input v-else-if="selectedQuestion.type==1" type="text" name="option-ext" @change="selectAnswer(selectedQuestion.question_marker,document.getElementsByName('option-ext')[0].value)">
                            <label>{{optionText}}</label>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-danger" @click="endExam()">End Exam</button>
                        <button class="btn btn-behance" @click="nextQuestion()" id="btn-next">Next</button>
                    </div>
                    <div class="pull-left">
                        <button class="btn btn-behance" @click="previousQuestion()" id="btn-previous">Previous</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div id="end-test-window" style="display: none">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Submitted Successfully!</h1>
                    <hr>
                    <h2 class="text-center">Kindly Close this window. Your certificate will be genrated within 72 hours after checking your simulation responses</h2>
                </div></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "QuestionModule",
        data() {
            return {
                attemptID:'',
                topicsAndQuestions: [],
                selectedQuestion: {},
                selectedTopic: '',
                markedAnswers:[],
                lastResponse:'',
                timeLeft:0
            }
        },
        methods:
            {
                selectQuestion(index, marker) {
                    let found=false;
                    this.$data.markedAnswers.forEach((dataAnswer,index)=>{
                        if (dataAnswer.markerID==marker){
                            found=true;
                            $("input[name=option][value=" + (this.$data.markedAnswers[index].answer-1) + "]").prop('checked', true);
                        }
                    });
                    if(found===false){
                        $("input[name=option]").prop('checked',false);
                    }
                    this.$data.selectedTopic = this.$data.topicsAndQuestions[index];
                    this.$data.selectedQuestion = this.$data.topicsAndQuestions[index].questions.find((ele, index) => ele.question_marker == marker);

                    let currentTopicIndice,currentQuestionIndice;
                    this.$data.topicsAndQuestions.forEach((topic,topicIndex)=>{
                        topic.questions.forEach((question,questionIndex)=>{
                            if(this.$data.selectedQuestion==question){
                                currentTopicIndice=topicIndex;
                                currentQuestionIndice=questionIndex;
                            }
                        })
                    })
                    let nextMarker,nextTopicIndice=currentTopicIndice,previousMarker,previousTopicIndice=currentTopicIndice;
                    if( typeof this.$data.topicsAndQuestions[currentTopicIndice].questions[currentQuestionIndice+1] =='undefined'){
                        nextTopicIndice+=1;
                        if(typeof this.$data.topicsAndQuestions[nextTopicIndice] == 'undefined')
                        {
                            $("#btn-next").hide();
                            return;
                        }
                        nextMarker=this.$data.topicsAndQuestions[currentTopicIndice+1].questions[0].question_marker;
                    }else {
                        nextMarker=this.$data.topicsAndQuestions[currentTopicIndice].questions[currentQuestionIndice+1].question_marker
                    }
                    $("#btn-next").show();
                    if( typeof this.$data.topicsAndQuestions[currentTopicIndice].questions[currentQuestionIndice-1] =='undefined'){
                        previousTopicIndice-=1;
                        if(typeof this.$data.topicsAndQuestions[previousTopicIndice] == 'undefined')
                        {
                            $("#btn-previous").hide();
                            return;
                        }
                        previousMarker=this.$data.topicsAndQuestions[currentTopicIndice-1].questions[0].question_marker;
                    }else {
                        previousMarker=this.$data.topicsAndQuestions[currentTopicIndice].questions[currentQuestionIndice-1].question_marker
                    }
                    $("#btn-previous").show();
                },
                selectAnswer(marker, answerIndice) {
                    let found=false;
                    this.$data.markedAnswers.forEach((dataAnswer,index)=>{
                        if (dataAnswer.markerID==marker){
                            found=true;
                            this.$data.markedAnswers[index].answer=answerIndice;
                        }
                    });
                    if(found===false){
                    this.$data.markedAnswers.push({attemptID:this.$data.attemptID,markerID:marker,answer:answerIndice});
                        }
                    axios.post('/api/put/answer',this.$data.markedAnswers)
                        .then(response=>{this.$data.lastResponse=response.data;this.$data.markedAnswers=response.data})
                        .catch(res=>swal.fire('Connection Error','Error sending your responses','error'))
                },
                nextQuestion()
                {
                    let currentTopicIndice,currentQuestionIndice;
                    this.$data.topicsAndQuestions.forEach((topic,topicIndex)=>{
                        topic.questions.forEach((question,questionIndex)=>{
                            if(this.$data.selectedQuestion==question){
                                currentTopicIndice=topicIndex;
                                currentQuestionIndice=questionIndex;
                            }
                        })
                    })
                    let nextMarker,nextTopicIndice=currentTopicIndice;
                    if( typeof this.$data.topicsAndQuestions[currentTopicIndice].questions[currentQuestionIndice+1] =='undefined'){
                        nextTopicIndice+=1;
                        nextMarker=this.$data.topicsAndQuestions[currentTopicIndice+1].questions[0].question_marker;
                    }else {
                        nextMarker=this.$data.topicsAndQuestions[currentTopicIndice].questions[currentQuestionIndice+1].question_marker
                    }
                    this.selectQuestion(nextTopicIndice,nextMarker)
                },
                previousQuestion()
                {
                    let currentTopicIndice,currentQuestionIndice;
                    this.$data.topicsAndQuestions.forEach((topic,topicIndex)=>{
                        topic.questions.forEach((question,questionIndex)=>{
                            if(this.$data.selectedQuestion==question){
                                currentTopicIndice=topicIndex;
                                currentQuestionIndice=questionIndex;
                            }
                        })
                    })
                    let previousMarker,previousTopicIndice=currentTopicIndice;
                    if( typeof this.$data.topicsAndQuestions[currentTopicIndice].questions[currentQuestionIndice-1] =='undefined'){
                        previousTopicIndice-=1;
                        if(typeof this.$data.topicsAndQuestions[previousTopicIndice] == 'undefined')
                        {
                            $("#btn-previous").hide();
                            return;
                        }
                        previousMarker=this.$data.topicsAndQuestions[currentTopicIndice-1].questions[0].question_marker;
                    }else {
                        previousMarker=this.$data.topicsAndQuestions[currentTopicIndice].questions[currentQuestionIndice-1].question_marker
                    }
                    this.selectQuestion(previousTopicIndice,previousMarker)
                },
                endExam()
                {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Submit it!'
                    }).then((result) => {
                        if (result.value) {
                            Swal.fire(
                                'Submitted!',
                                'Your responses has been submitted.',
                                'success'
                            ).then(val=>{
                                $('#content-window').hide();
                                $('#end-test-window').show();
                                topicsWithQuestions=[];
                                this.$destroy();
                            })
                        }
                    })
                },
            },
        mounted(){
            $('#end-test-window').hide();
            $('#btn-previous').hide();
            setInterval(()=>{
                this.$data.timeLeft-=1;
                if(this.$data.timeLeft<=0)
                {
                    $('#content-window').hide();
                    $('#end-test-window').show();
                    topicsWithQuestions=[];
                    this.$destroy();
                }
            },1000);
          setInterval(()=>{
              if(this.$data.lastResponse=="")
              {
                  this.$data.markedAnswers=[];
              }
              this.$data.topicsAndQuestions.forEach((topic,topicIndex)=>{
                  topic.questions.forEach((question,quesIndex)=>{
                      let marker=this.$data.markedAnswers.find((ele, index) => ele.markerID == question.question_marker);
                      if(typeof marker !='undefined'){
                          $('#btn-'+marker.markerID).removeClass('btn-primary').addClass('btn-success');
                      }else {
                          $('#btn-'+question.question_marker).removeClass('btn-success').addClass('btn-primary');
                      }
                  });
              });
          },250);
        },
        beforeMount() {
            if (this.$data.topicsAndQuestions.length === 0){
                this.$data.timeLeft=timer*60,
                this.$data.attemptID=loraXampIDSYU;
                this.$data.topicsAndQuestions = topicsWithQuestions;
            }else{
                swal.fire('Error loading Test Data','Kindly contact server administrator with your credetials','error')
            }
            this.$data.selectedTopic = this.$data.topicsAndQuestions[0];
            this.$data.selectedQuestion = this.$data.topicsAndQuestions[0].questions[0];
        }
    }
</script>

<style scoped>
    .btn-spaced {
        width: 50px;
        margin: 0.07rem;
    }
</style>
