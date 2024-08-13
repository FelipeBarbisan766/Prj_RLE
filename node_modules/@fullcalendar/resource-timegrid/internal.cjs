'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

var internal_cjs$1 = require('@fullcalendar/core/internal.cjs');
var preact_cjs = require('@fullcalendar/core/preact.cjs');
var internal_cjs$2 = require('@fullcalendar/timegrid/internal.cjs');
var internal_cjs = require('@fullcalendar/resource/internal.cjs');
var internal_cjs$3 = require('@fullcalendar/resource-daygrid/internal.cjs');

class ResourceDayTimeColsJoiner extends internal_cjs.VResourceJoiner {
    transformSeg(seg, resourceDayTable, resourceI) {
        return [
            Object.assign(Object.assign({}, seg), { col: resourceDayTable.computeCol(seg.col, resourceI) }),
        ];
    }
}

class ResourceDayTimeCols extends internal_cjs$1.DateComponent {
    constructor() {
        super(...arguments);
        this.buildDayRanges = internal_cjs$1.memoize(internal_cjs$2.buildDayRanges);
        this.splitter = new internal_cjs.VResourceSplitter();
        this.slicers = {};
        this.joiner = new ResourceDayTimeColsJoiner();
        this.timeColsRef = preact_cjs.createRef();
        this.isHitComboAllowed = (hit0, hit1) => {
            let allowAcrossResources = this.dayRanges.length === 1;
            return allowAcrossResources || hit0.dateSpan.resourceId === hit1.dateSpan.resourceId;
        };
    }
    render() {
        let { props, context } = this;
        let { dateEnv, options } = context;
        let { dateProfile, resourceDayTableModel } = props;
        let dayRanges = this.dayRanges = this.buildDayRanges(resourceDayTableModel.dayTableModel, dateProfile, dateEnv);
        let splitProps = this.splitter.splitProps(props);
        this.slicers = internal_cjs$1.mapHash(splitProps, (split, resourceId) => this.slicers[resourceId] || new internal_cjs$2.DayTimeColsSlicer());
        let slicedProps = internal_cjs$1.mapHash(this.slicers, (slicer, resourceId) => slicer.sliceProps(splitProps[resourceId], dateProfile, null, context, dayRanges));
        return ( // TODO: would move this further down hierarchy, but sliceNowDate needs it
        preact_cjs.createElement(internal_cjs$1.NowTimer, { unit: options.nowIndicator ? 'minute' : 'day' }, (nowDate, todayRange) => (preact_cjs.createElement(internal_cjs$2.TimeCols, Object.assign({ ref: this.timeColsRef }, this.joiner.joinProps(slicedProps, resourceDayTableModel), { dateProfile: dateProfile, axis: props.axis, slotDuration: props.slotDuration, slatMetas: props.slatMetas, cells: resourceDayTableModel.cells[0], tableColGroupNode: props.tableColGroupNode, tableMinWidth: props.tableMinWidth, clientWidth: props.clientWidth, clientHeight: props.clientHeight, expandRows: props.expandRows, nowDate: nowDate, nowIndicatorSegs: options.nowIndicator && this.buildNowIndicatorSegs(nowDate), todayRange: todayRange, onScrollTopRequest: props.onScrollTopRequest, forPrint: props.forPrint, onSlatCoords: props.onSlatCoords, isHitComboAllowed: this.isHitComboAllowed })))));
    }
    buildNowIndicatorSegs(date) {
        let nonResourceSegs = this.slicers[''].sliceNowDate(date, this.props.dateProfile, this.context.options.nextDayThreshold, this.context, this.dayRanges);
        return this.joiner.expandSegs(this.props.resourceDayTableModel, nonResourceSegs);
    }
}

class ResourceDayTimeColsView extends internal_cjs$2.TimeColsView {
    constructor() {
        super(...arguments);
        this.flattenResources = internal_cjs$1.memoize(internal_cjs.flattenResources);
        this.buildResourceTimeColsModel = internal_cjs$1.memoize(buildResourceTimeColsModel);
        this.buildSlatMetas = internal_cjs$1.memoize(internal_cjs$2.buildSlatMetas);
    }
    render() {
        let { props, context } = this;
        let { options, dateEnv } = context;
        let { dateProfile } = props;
        let splitProps = this.allDaySplitter.splitProps(props);
        let resourceOrderSpecs = options.resourceOrder || internal_cjs.DEFAULT_RESOURCE_ORDER;
        let resources = this.flattenResources(props.resourceStore, resourceOrderSpecs);
        let resourceDayTableModel = this.buildResourceTimeColsModel(dateProfile, context.dateProfileGenerator, resources, options.datesAboveResources, context);
        let slatMetas = this.buildSlatMetas(dateProfile.slotMinTime, dateProfile.slotMaxTime, options.slotLabelInterval, options.slotDuration, dateEnv);
        let { dayMinWidth } = options;
        let hasAttachedAxis = !dayMinWidth;
        let hasDetachedAxis = dayMinWidth;
        let headerContent = options.dayHeaders && (preact_cjs.createElement(internal_cjs.ResourceDayHeader, { resources: resources, dates: resourceDayTableModel.dayTableModel.headerDates, dateProfile: dateProfile, datesRepDistinctDays: true, renderIntro: hasAttachedAxis ? this.renderHeadAxis : null }));
        let allDayContent = (options.allDaySlot !== false) && ((contentArg) => (preact_cjs.createElement(internal_cjs$3.ResourceDayTable, Object.assign({}, splitProps.allDay, { dateProfile: dateProfile, resourceDayTableModel: resourceDayTableModel, nextDayThreshold: options.nextDayThreshold, tableMinWidth: contentArg.tableMinWidth, colGroupNode: contentArg.tableColGroupNode, renderRowIntro: hasAttachedAxis ? this.renderTableRowAxis : null, showWeekNumbers: false, expandRows: false, headerAlignElRef: this.headerElRef, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, forPrint: props.forPrint }, this.getAllDayMaxEventProps()))));
        let timeGridContent = (contentArg) => (preact_cjs.createElement(ResourceDayTimeCols, Object.assign({}, splitProps.timed, { dateProfile: dateProfile, axis: hasAttachedAxis, slotDuration: options.slotDuration, slatMetas: slatMetas, resourceDayTableModel: resourceDayTableModel, tableColGroupNode: contentArg.tableColGroupNode, tableMinWidth: contentArg.tableMinWidth, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, onSlatCoords: this.handleSlatCoords, expandRows: contentArg.expandRows, forPrint: props.forPrint, onScrollTopRequest: this.handleScrollTopRequest })));
        return hasDetachedAxis
            ? this.renderHScrollLayout(headerContent, allDayContent, timeGridContent, resourceDayTableModel.colCnt, dayMinWidth, slatMetas, this.state.slatCoords)
            : this.renderSimpleLayout(headerContent, allDayContent, timeGridContent);
    }
}
function buildResourceTimeColsModel(dateProfile, dateProfileGenerator, resources, datesAboveResources, context) {
    let dayTable = internal_cjs$2.buildTimeColsModel(dateProfile, dateProfileGenerator);
    return datesAboveResources ?
        new internal_cjs.DayResourceTableModel(dayTable, resources, context) :
        new internal_cjs.ResourceDayTableModel(dayTable, resources, context);
}

exports.ResourceDayTimeCols = ResourceDayTimeCols;
exports.ResourceDayTimeColsView = ResourceDayTimeColsView;
