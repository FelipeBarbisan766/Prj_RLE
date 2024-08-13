import { createElement, VNode, RefObject } from '@fullcalendar/core/preact';
import { TableView } from '@fullcalendar/daygrid/internal';
import { ResourceViewProps, AbstractResourceDayTableModel } from '@fullcalendar/resource/internal';
import { Duration, CssDimValue } from '@fullcalendar/core';
import { DateComponent, Hit, DateProfile, EventStore, EventUiHash, DateSpan, EventInteractionState } from '@fullcalendar/core/internal';

declare class ResourceDayTableView extends TableView {
    props: ResourceViewProps;
    private flattenResources;
    private buildResourceDayTableModel;
    private headerRef;
    private tableRef;
    render(): createElement.JSX.Element;
}

interface ResourceDayTableProps {
    dateProfile: DateProfile;
    resourceDayTableModel: AbstractResourceDayTableModel;
    businessHours: EventStore;
    eventStore: EventStore;
    eventUiBases: EventUiHash;
    dateSelection: DateSpan | null;
    eventSelection: string;
    eventDrag: EventInteractionState | null;
    eventResize: EventInteractionState | null;
    nextDayThreshold: Duration;
    tableMinWidth: CssDimValue;
    colGroupNode: VNode;
    renderRowIntro?: () => VNode;
    dayMaxEvents: boolean | number;
    dayMaxEventRows: boolean | number;
    expandRows: boolean;
    showWeekNumbers: boolean;
    headerAlignElRef?: RefObject<HTMLElement>;
    clientWidth: number | null;
    clientHeight: number | null;
    forPrint: boolean;
}
declare class ResourceDayTable extends DateComponent<ResourceDayTableProps> {
    private splitter;
    private slicers;
    private joiner;
    private tableRef;
    render(): createElement.JSX.Element;
    isHitComboAllowed: (hit0: Hit, hit1: Hit) => boolean;
}

export { ResourceDayTable, ResourceDayTableView };
