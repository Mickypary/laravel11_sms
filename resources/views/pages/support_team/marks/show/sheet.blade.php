<table class="table table-bordered table-responsive text-center">
  <thead>
  <tr>
      <th rowspan="2">S/N</th>
      <th rowspan="2">SUBJECTS</th>
      <th rowspan="2">MIDTERM<br>(20)</th>
      <th rowspan="2">CA1<br>(20)</th>
      <th rowspan="2">CA2<br>(20)</th>
      <th rowspan="2">EXAMS<br>(60)</th>
      <th rowspan="2">TOTAL<br>(100)</th>

      @if($ex->term == 3) 
      <th rowspan="2">TOTAL <br>(100%) 3<sup>RD</sup> TERM</th>
      <th rowspan="2">1<sup>ST</sup> <br> TERM</th>
      <th rowspan="2">2<sup>ND</sup> <br> TERM</th>
      <th rowspan="2">CUM (300%) <br> 1<sup>ST</sup> + 2<sup>ND</sup> + 3<sup>RD</sup></th>
      <th rowspan="2">CUM AVE</th>
      @endif

      <th rowspan="2">GRADE</th>
      <th rowspan="2">SUBJECT <br> POSITION</th>
      <th rowspan="2">REMARKS</th>
  </tr>
  </thead>

  <tbody>
  @foreach($subjects as $sub)
                @php 
                    $midconv = 'mid'.$ex->term.'conv';
                @endphp
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $sub->name }}</td>
          @foreach($marks->where('subject_id', $sub->id)->where('exam_id', $ex->id) as $mk)
              <td>{{ ($mk->$midconv) ?: '-' }}</td>
              <td>{{ ($mk->t3) ?: '-' }}</td>
              <td>{{ ($mk->t4) ?: '-' }}</td>
              <td>{{ ($mk->exm) ?: '-' }}</td>
              
              
              <td>
                @php 
                    $endtotal = 'end'.$ex->term.'total';
                @endphp
                  @if($ex->term === 1) {{ ($mk->$endtotal) }}
                  @elseif ($ex->term === 2) {{ ($mk->$endtotal) }}
                  @elseif ($ex->term === 3) {{ ($mk->$endtotal) }}
                  @else {{ '-' }}
                  @endif
              </td>
              {{-- {{ dd('pary'); }} --}}

              {{--3rd Term--}}
              @if($ex->term == 3)
                   <td>{{ $mk->$endtotal ?: '-' }}</td>
                   <td>{{ Mk::getSubTotalTerm($student_id, $sub->id, 1, $mk->my_class_id, $year) }}</td>
                   <td>{{ Mk::getSubTotalTerm($student_id, $sub->id, 2, $mk->my_class_id, $year) }}</td>
                   <td>{{ $mk->cum ? $mk->cum : '-' }}</td>
                   <td>{{ $mk->cum_ave ?: '-' }}</td>
               @endif

              {{--Grade, Subject Position & Remarks--}}
              <td>{{ ($mk->grade) ? $mk->grade->name : '-' }}</td>
              <td>{!! ($mk->grade) ? Mk::getSuffix($mk->sub_pos) : '-' !!}</td>
              <td>{{ ($mk->grade) ? $mk->grade->remark : '-' }}</td>
          @endforeach
      </tr>
  @endforeach
  <tr>
      <td colspan="4"><strong>TOTAL SCORES OBTAINED: </strong> {{ $exr->total }}</td>
      <td colspan="3"><strong>FINAL AVERAGE: </strong> {{ $exr->ave }}</td>
      <td colspan="2"><strong>CLASS AVERAGE: </strong> {{ $exr->class_ave }}</td>
  </tr>
  </tbody>
</table>
