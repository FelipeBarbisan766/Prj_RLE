'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

var internal_cjs$1 = require('@fullcalendar/core/internal.cjs');
var preact_cjs = require('@fullcalendar/core/preact.cjs');
var internal_cjs$2 = require('@fullcalendar/daygrid/internal.cjs');
var internal_cjs = require('@fullcalendar/resource/internal.cjs');

class ResourceDayTableJoiner extends internal_cjs.VResourceJoiner {
    transformSeg(seg, resourceDayTableModel, resourceI) {
        let colRanges = resourceDayTableModel.computeColRanges(seg.firstCol, seg.lastCol, resourceI);
        return colRanges.map((colRange) => (Object.assign(Object.assign(Object.assign({}, seg), colRange), { isStart: seg.isStart && colRange.isStart, isEnd: seg.isEnd && colRange.isEnd })));
    }
}

class ResourceDayTable extends internal_cjs$1.DateComponent {
    constructor() {
        super(...arguments);
        this.splitter = new internal_cjs.VResourceSplitter();
        this.slicers = {};
        this.joiner = new ResourceDayTableJoiner();
        this.tableRef = preact_cjs.createRef();
        this.isHitComboAllowed = (hit0, hit1) => {
            let allowAcrossResources = this.props.resourceDayTableModel.dayTableModel.colCnt === 1;
            return allowAcrossResources || hit0.dateSpan.resourceId === hit1.dateSpan.resourceId;
        };
    }
    render() {
        let { props, context } = this;
        let { resourceDayTableModel, nextDayThreshold, dateProfile } = props;
        let splitProps = this.splitter.splitProps(props);
        this.slicers = internal_cjs$1.mapHash(splitProps, (split, resourceId) => this.slicers[resourceId] || new internal_cjs$2.DayTableSlicer());
        let slicedProps = internal_cjs$1.mapHash(this.slicers, (slicer, resourceId) => slicer.sliceProps(splitProps[resourceId], dateProfile, nextDayThreshold, context, resourceDayTableModel.dayTableModel));
        return (preact_cjs.createElement(internal_cjs$2.Table, Object.assign({ forPrint: props.forPrint, ref: this.tableRef }, this.joiner.joinProps(slicedProps, resourceDayTableModel), { cells: resourceDayTableModel.cells, dateProfile: dateProfile, colGroupNode: props.colGroupNode, tableMinWidth: props.tableMinWidth, renderRowIntro: props.renderRowIntro, dayMaxEvents: props.dayMaxEvents, dayMaxEventRows: props.dayMaxEventRows, showWeekNumbers: props.showWeekNumbers, expandRows: props.expandRows, headerAlignElRef: props.headerAlignElRef, clientWidth: props.clientWidth, clientHeight: props.clientHeight, isHitComboAllowed: this.isHitComboAllowed })));
    }
}

class ResourceDayTableView extends internal_cjs$2.TableView {
    constructor() {
        super(...arguments);
        this.flattenResources = internal_cjs$1.memoize(internal_cjs.flattenResources);
        this.buildResourceDayTableModel = internal_cjs$1.memoize(buildResourceDayTableModel);
        this.headerRef = preact_cjs.createRef();
        this.tableRef = preact_cjs.createRef();
        // can't override any lifecycle methods from parent
    }
    render() {
        let { props, context } = this;
        let { options } = context;
        let resourceOrderSpecs = options.resourceOrder || internal_cjs.DEFAULT_RESOURCE_ORDER;
        let resources = this.flattenResources(props.resourceStore, resourceOrderSpecs);
        let resourceDayTableModel = this.buildResourceDayTableModel(props.dateProfile, context.dateProfileGenerator, resources, options.datesAboveResources, context);
        let headerContent = options.dayHeaders && (preact_cjs.createElement(internal_cjs.ResourceDayHeader, { ref: this.headerRef, resources: resources, dateProfile: props.dateProfile, dates: resourceDayTableModel.dayTableModel.headerDates, datesRepDistinctDays: true }));
        let bodyContent = (contentArg) => (preact_cjs.createElement(ResourceDayTable, { ref: this.tableRef, dateProfile: props.dateProfile, resourceDayTableModel: resourceDayTableModel, businessHours: props.businessHours, eventStore: props.eventStore, eventUiBases: props.eventUiBases, dateSelection: props.dateSelection, eventSelection: props.eventSelection, eventDrag: props.eventDrag, eventResize: props.eventResize, nextDayThreshold: options.nextDayThreshold, tableMinWidth: contentArg.tableMinWidth, colGroupNode: contentArg.tableColGroupNode, dayMaxEvents: options.dayMaxEvents, dayMaxEventRows: options.dayMaxEventRows, showWeekNumbers: options.weekNumbers, expandRows: !props.isHeightAuto, headerAlignElRef: this.headerElRef, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, forPrint: props.forPrint }));
        return options.dayMinWidth
            ? this.renderHScrollLayout(headerContent, bodyContent, resourceDayTableModel.colCnt, options.dayMinWidth)
            : this.renderSimpleLayout(headerContent, bodyContent);
    }
}
function buildResourceDayTableModel(dateProfile, dateProfileGenerator, resources, datesAboveResources, context) {
    let dayTable = internal_cjs$2.buildDayTableModel(dateProfile, dateProfileGenerator);
    return datesAboveResources ?
        new internal_cjs.DayResourceTableModel(dayTable, resources, context) :
        new internal_cjs.ResourceDayTableModel(dayTable, resources, context);
}

exports.ResourceDayTable = ResourceDayTable;
exports.ResourceDayTableView = ResourceDayTableView;
