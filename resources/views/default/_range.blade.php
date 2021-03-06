@if(!isset($inline) || !$inline)
<div class="block">
    <div class="block-content pt-3">
@endif
        <div class="row gutters-tiny">
            <div class="{{ isset($rangeField) ? 'col-lg-6' : 'col-lg-12' }}">
                <div class="form-group">
                    @if(!isset($inline) || !$inline)
                        <label for="range_input">Range</label>
                    @endif
                    <input type="text" id="range_input" autocomplete="off" class="form-control form-control-lg" />
                    <input type="hidden" name="range" id="range" value="{{ $range }}">
                    <script type="text/javascript">
                        $(function () {
                            let range = $('#range').val();
                            let dates = range.split(',');
                            let start_date = dates[0];
                            let end_date = dates[1];
                            let $input = $('#range_input');
                            if(typeof start_date !== 'undefined' && start_date !== null && start_date.length > 0 &&
                                typeof end_date !== 'undefined' && end_date !== null && end_date.length
                            ) {
                                $input.val(start_date + ' ' + end_date);
                            }
                            $input
                                .daterangepicker({
                                    startDate: typeof start_date !== 'undefined' && start_date !== null && start_date.length > 0 ? start_date : moment,
                                    endDate: typeof end_date !== 'undefined' && end_date !== null && end_date.length > 0 ? end_date : moment,
                                    autoApply: true,
                                    @if(!isset($start) || !isset($end))
                                    autoUpdateInput: false,
                                    @endif
                                    opens: 'lefts',
                                    ranges: {
                                        @if(isset($config_ranges))
                                            {{ $config_ranges }}
                                        @endif
                                    },
                                    locale: {
                                        cancelLabel: 'Clear',
                                        format: 'DD.MM.YYYY',
                                    }
                                })
                                .on('apply.daterangepicker', function(ev, picker) {
                                    $('#range').val(picker.startDate.format('DD.MM.YYYY') + ',' + picker.endDate.format('DD.MM.YYYY'));
                                    $(this).val(picker.startDate.format('DD.MM.YYYY') + ' ' + picker.endDate.format('DD.MM.YYYY'));
                                })
                                @if(!isset($start) || !isset($end))
                                .change(function(e) {
                                    if($(this).val().length === 0) {
                                        $('#range').val('');
                                    }
                                })
                            @endif
                            ;
                        });
                    </script>
                </div>
            </div>
            @if (isset($rangeField))
                @php
                    $selected = $value[3] ?? [];
                @endphp
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="range_field">Searchable range field</label>
                        <select name="range_field" id="range_field" class="form-control">
                            @foreach($range_field as $value => $label)
                                <option value="{{ $value }}" @if($selected == $value) selected @endif>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
@if(!isset($inline) || !$inline)
    </div>
</div>
@endif
