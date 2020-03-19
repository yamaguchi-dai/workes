<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">勤怠状況</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">日</th>
                                <th scope="col">出勤</th>
                                <th scope="col">退勤</th>
                                <th scope="col">休憩計</th>
                                <th scope="col">合計稼働時間</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="work_time in work_time_list">
                                <td>{{ work_time.day }}({{work_time.week_day}})</td>
                                <td>{{ work_time.work_start_time }}</td>
                                <td>{{ work_time.work_end_time }}</td>
                                <td>{{ work_time.sum_break_time }}</td>
                                <td class="day_work_sum_time">{{ work_time.day_work_time }}</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>合計</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{sum_month_time}}</td>
                            </tr>


                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                work_time_list: []
            }
        },
        mounted() {
            console.log(this.props);
            axios.get('/api/report/day_summary?api_token=' + $('meta[name="api_token"]').attr('content')).then(res => this.work_time_list = res.data)
        },
        computed: {
            sum_month_time() {
                let hh_sum = 0;
                let mm_sum = 0;
                //
                $.each(this.work_time_list, (val1, val2) => {
                    let day_time = val2['day_work_time'];
                    if (day_time === null) day_time = '00:00';
                    let tmp_hh_mm_arr = day_time.split(':');
                    hh_sum += parseInt(tmp_hh_mm_arr[0]);
                    mm_sum += parseInt(tmp_hh_mm_arr[1]);

                });
                console.log(hh_sum + 'HH_SUM');
                console.log(mm_sum + 'MM_SUM');
                //分を時に変換
                let mm_to_hh = Math.floor(mm_sum / 60);//分を時に変換
                hh_sum += mm_to_hh;
                mm_sum = mm_sum - (mm_to_hh * 60);//時に変換した分を
                console.log(hh_sum + ':' + mm_sum);

                return hh_sum + ':' + ('00' + mm_sum).slice(-2);
            }
        }
    }
</script>
