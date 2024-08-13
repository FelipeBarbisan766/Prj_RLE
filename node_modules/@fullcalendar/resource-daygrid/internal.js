import { DateComponent, mapHash, memoize } from '@fullcalendar/core/internal.js';
import { createRef, createElement } from '@fullcalendar/core/preact.js';
import { DayTableSlicer, Table, TableView, buildDayTableModel } from '@fullcalendar/daygrid/internal.js';
import { VResourceJoiner, VResourceSplitter, flattenResources, DEFAULT_RESOURCE_ORDER, ResourceDayHeader, DayResourceTableModel, ResourceDayTableModel } from '@fullcalendar/resource/internal.js';

class ResourceDayTableJoiner extends VResourceJoiner {
    transformSeg(seg, resourceDayTableModel, resourceI) {
        let colRanges = resourceDayTableModel.computeColRanges(seg.firstCol, seg.lastCol, resourceI);
        return colRanges.map((colRange) => (Object.assign(Object.assign(Object.assign({}, seg), colRange), { isStart: seg.isStart && colRange.isStart, isEnd: seg.isEnd && colRange.isEnd })));
    }
}

class ResourceDayTable extends DateComponent {
    constructor() {
        super(...arguments);
        this.splitter = new VResourceSplitter();
        this.slicers = {};
        this.joiner = new ResourceDayTableJoiner();
        this.tableRef = createRef();
        this.isHitComboAllowed = (hit0, hit1) => {
            let allowAcrossResources = this.props.resourceDayTableModel.dayTableModel.colCnt === 1;
            return allowAcrossResources || hit0.dateSpan.resourceId === hit1.dateSpan.resourceId;
        };
    }
    render() {
        let { props, context } = this;
        let { resourceDayTableModel, nextDayThreshold, dateProfile } = props;
        let splitProps = this.splitter.splitProps(props);
        this.slicers = mapHash(splitProps, (split, resourceId) => this.slicers[resourceId] || new DayTableSlicer());
        let slicedProps = mapHash(this.slicers, (slicer, resourceId) => slicer.sliceProps(splitProps[resourceId], dateProfile, nextDayThreshold, context, resourceDayTableModel.dayTableModel));
        return (createElement(Table, Object.assign({ forPrint: props.forPrint, ref: this.tableRef }, this.joiner.joinProps(slicedProps, resourceDayTableModel), { cells: resourceDayTableModel.cells, dateProfile: dateProfile, colGroupNode: props.colGroupNode, tableMinWidth: props.tableMinWidth, renderRowIntro: props.renderRowIntro, dayMaxEvents: props.dayMaxEvents, dayMaxEventRows: props.dayMaxEventRows, showWeekNumbers: props.showWeekNumbers, expandRows: props.expandRows, headerAlignElRef: props.headerAlignElRef, clientWidth: props.clientWidth, clientHeight: props.clientHeight, isHitComboAllowed: this.isHitComboAllowed })));
    }
}

class ResourceDayTableView extends TableView {
    constructor() {
        super(...arguments);
        this.flattenResources = memoize(flattenResources);
        this.buildResourceDayTableModel = memoize(buildResourceDayTableModel);
        this.headerRef = createRef();
        this.tableRef = createRef();
        // can't override any lifecycle methods from parent
    }
    render() {
        let { props, context } = this;
        let { options } = context;
        let resourceOrderSpecs = options.resourceOrder || DEFAULT_RESOURCE_ORDER;
        let resources = this.flattenResources(props.resourceStore, resourceOrderSpecs);
        let resourceDayTableModel = this.buildResourceDayTableModel(props.dateProfile, context.dateProfileGenerator, resources, options.datesAboveResources, context);
        let headerContent = options.dayHeaders && (createElement(ResourceDayHeader, { ref: this.headerRef, resources: resources, dateProfile: props.dateProfile, dates: resourceDayTableModel.dayTableModel.headerDates, datesRepDistinctDays: true }));
        let bodyContent = (contentArg) => (createElement(ResourceDayTable, { ref: this.tableRef, dateProfile: props.dateProfile, resourceDayTableModel: resourceDayTableModel, businessHours: props.businessHours, eventStore: props.eventStore, eventUiBases: props.eventUiBases, dateSelection: props.dateSelection, eventSelection: props.eventSelection, eventDrag: props.eventDrag, eventResize: props.eventResize, nextDayThreshold: options.nextDayThreshold, tableMinWidth: contentArg.tableMinWidth, colGroupNode: contentArg.tableColGroupNode, dayMaxEvents: options.dayMaxEvents, dayMaxEventRows: options.dayMaxEventRows, showWeekNumbers: options.weekNumbers, expandRows: !props.isHeightAuto, headerAlignElRef: this.headerElRef, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, forPrint: props.forPrint }));
        return options.dayMinWidth
            ? this.renderHScrollLayout(headerContent, bodyContent, resourceDayTableModel.colCnt, options.dayMinWidth)
            : this.renderSimpleLayout(headerContent, bodyContent);
    }
}
function buildResourceDayTableModel(dateProfile, dateProfileGenerator, resources, datesAboveResources, context) {
    let dayTable = buildDayTableModel(dateProfile, dateProfileGenerator);
    return datesAboveResources ?
        new DayResourceTableModel(dayTable, resources, context) :
        new ResourceDayTableModel(dayTable, resources, context);
}

export { ResourceDayTable, ResourceDayTableView };
