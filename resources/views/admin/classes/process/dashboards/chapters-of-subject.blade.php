@extends('admin.master')
@section('content')
    <h5>Quá trình của học sinh {{$student->name}}</h5>
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title mt-0">Tổng quan các chương</h4>
            <div class="">
                <div id="ana_dash_1" class="apex-charts"></div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        @foreach($chapters as $chapter)
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <div class="icon-info">
                                    <i class="mdi mdi-book-multiple"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="ml-2">
                                    <a href="{{route('classes.process-detail',[$student->id, $chapter->id])}}">
                                        <h3>{{$chapter->chapter_name}}</h3></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
    <script>
        <?php
        $chapters = [];
        $totalQuestions = [];
        foreach ($countQuestionsOfChapter as $key => $value) {
            $chapters[] = '"' . substr($key, 0, 10) . '"';
            $totalQuestions[] = '"' . $value . '"';
        }



        $arrayChapters = '[' . implode(',', $chapters) . ']';
        $totalQuestions = '[' . implode(',', $totalQuestions) . ']';
        $totalReviews = '[' . implode(',', $reviews) . ']';
        $corectReviews = '[' . implode(',', $arrayCountCorrect) . ']';

        ?>


        let chapters = <?php echo $arrayChapters; ?>;
        let totalQuestions = <?php echo $totalQuestions; ?>;
        let reviewdQuestion = <?php echo $totalReviews; ?>;
        let corectReviews = <?php echo $corectReviews; ?>;
        var options = {
            chart: {
                height: 340,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    // endingShape: 'rounded',
                    columnWidth: '25%',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            colors: ["#4d79f6", "#e0e7fd", "#6eef7f"],
            series: [{
                name: 'Tổng số câu hỏi',
                data: totalQuestions
            }, {
                name: 'Câu hỏi đã ôn tập',
                data: reviewdQuestion
            },{
                name: 'Câu hỏi đã ôn tập đúng',
                data: corectReviews
            }
            ],
            xaxis: {
                categories: chapters,
                axisBorder: {
                    show: true,
                    color: '#bec7e0',
                },
                axisTicks: {
                    show: true,
                    color: '#bec7e0',
                },
            },
            legend: {
                offsetY: -10,
            },
            yaxis: {
                title: {
                    text: 'Câu hỏi'
                }
            },
            fill: {
                opacity: 1

            },
            // legend: {
            //     floating: true
            // },
            grid: {
                row: {
                    colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.2
                },
                borderColor: '#f1f3fa'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "" + val
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#ana_dash_1"),
            options
        );

        chart.render();
    </script>
@endsection
