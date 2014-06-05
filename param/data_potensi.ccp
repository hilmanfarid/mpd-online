<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="688" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_restaurantGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="t_cacc_dtl_restaurant">
			<Components>
				<Label id="693" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_type_desc" fieldSource="service_type_desc" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridservice_type_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="694" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="695" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cacc_dtl_restaurant_id" fieldSource="t_cacc_dtl_restaurant_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridt_cacc_dtl_restaurant_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="755" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_restaurantGridDLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_restaurant_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="940" sourceType="DataField" name="t_cacc_dtl_restaurant_id" source="t_cacc_dtl_restaurant_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="757" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_restaurantGridADLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_restaurant_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="941" sourceType="DataField" name="t_cacc_dtl_restaurant_id" source="t_cacc_dtl_restaurant_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="775" fieldSourceType="DBColumn" dataType="Text" html="False" name="seat_qty" fieldSource="seat_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridseat_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="776" fieldSourceType="DBColumn" dataType="Text" html="False" name="table_qty" fieldSource="table_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridtable_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="777" fieldSourceType="DBColumn" dataType="Text" html="False" name="max_service_qty" fieldSource="max_service_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridmax_service_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="778" fieldSourceType="DBColumn" dataType="Float" html="False" name="avg_subscription" fieldSource="avg_subscription" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridavg_subscription" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="969" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="1027" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_restaurantGridvalid_from" fieldSource="valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1034" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_restaurantGridvalid_to" fieldSource="valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="701" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="764" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="937" conditionType="Parameter" useIsNull="False" field="t_cust_account_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_account_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="936" tableName="t_cacc_dtl_restaurant" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="790" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_hotelGrid1" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT t_cacc_dtl_hotel_id, t_cust_account_id, a.p_room_type_id, room_qty, service_qty, service_charge_wd, service_charge_we,
valid_from, valid_to, a.description, a.creation_date, a.created_by,
a.updated_date , a.updated_by, b.code AS room_type_code 
FROM t_cacc_dtl_hotel a INNER JOIN p_room_type b ON
a.p_room_type_id = b.p_room_type_id
WHERE a.t_cust_account_id = {t_cust_account_id} ">
			<Components>
				<Navigator id="792" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Link id="794" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_hotelGrid1DLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_hotel_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="942" sourceType="DataField" name="t_cacc_dtl_hotel_id" source="t_cacc_dtl_hotel_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="796" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_hotelGrid1ADLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_hotel_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="943" sourceType="DataField" name="t_cacc_dtl_hotel_id" source="t_cacc_dtl_hotel_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="798" fieldSourceType="DBColumn" dataType="Text" html="False" name="room_type_code" fieldSource="room_type_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1room_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="799" fieldSourceType="DBColumn" dataType="Float" html="False" name="room_qty" fieldSource="room_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1room_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="802" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_qty" fieldSource="service_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1service_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="801" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge_wd" fieldSource="service_charge_wd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1service_charge_wd" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="914" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge_we" fieldSource="service_charge_we" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1service_charge_we" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="793" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cacc_dtl_hotel_id" fieldSource="t_cacc_dtl_hotel_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1t_cacc_dtl_hotel_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="968" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="1028" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_hotelGrid1valid_from" fieldSource="valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1035" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_hotelGrid1valid_to" fieldSource="valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="806" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="807" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="962" conditionType="Parameter" useIsNull="False" field="a.t_cust_account_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_account_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="938" tableName="t_cacc_dtl_hotel" posLeft="10" posTop="10" posWidth="146" posHeight="180" alias="a"/>
				<JoinTable id="958" tableName="p_room_type" alias="b" posLeft="177" posTop="10" posWidth="125" posHeight="168"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="959" tableLeft="a" tableRight="b" fieldLeft="a.p_room_type_id" fieldRight="b.p_room_type_id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="944" tableName="a" fieldName="t_cacc_dtl_hotel_id"/>
				<Field id="945" tableName="a" fieldName="t_cust_account_id"/>
				<Field id="946" tableName="a" fieldName="a.p_room_type_id" alias="a_p_room_type_id"/>
				<Field id="947" tableName="a" fieldName="room_qty"/>
				<Field id="948" tableName="a" fieldName="service_qty"/>
				<Field id="949" tableName="a" fieldName="service_charge_wd"/>
				<Field id="950" tableName="a" fieldName="service_charge_we"/>
				<Field id="951" tableName="a" fieldName="valid_from"/>
				<Field id="952" tableName="a" fieldName="valid_to"/>
				<Field id="953" tableName="a" fieldName="a.description" alias="a_description"/>
				<Field id="954" tableName="a" fieldName="a.creation_date" alias="a_creation_date"/>
				<Field id="955" tableName="a" fieldName="a.created_by" alias="a_created_by"/>
				<Field id="956" tableName="a" fieldName="a.updated_date" alias="a_updated_date"/>
				<Field id="957" tableName="a" fieldName="a.updated_by" alias="a_updated_by"/>
				<Field id="961" fieldName="b.code" isExpression="True" alias="room_type_code"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="963" parameterType="URL" variable="t_cust_account_id" dataType="Float" parameterSource="t_cust_account_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="814" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="v_vat_reg_dtl_entertaintmentGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="t_cacc_dtl_entertaintment">
			<Components>
				<Label id="815" fieldSourceType="DBColumn" dataType="Text" html="False" name="entertainment_desc" fieldSource="entertainment_desc" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridentertainment_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="816" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="817" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cacc_dtl_entertaintment_id" fieldSource="t_cacc_dtl_entertaintment_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridt_cacc_dtl_entertaintment_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="818" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="v_vat_reg_dtl_entertaintmentGridDLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_entertaintment_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="966" sourceType="DataField" name="t_cacc_dtl_entertaintment_id" source="t_cacc_dtl_entertaintment_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="820" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="v_vat_reg_dtl_entertaintmentGridADLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_entertaintment_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="967" sourceType="DataField" name="t_cacc_dtl_entertaintment_id" source="t_cacc_dtl_entertaintment_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="822" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge_wd" fieldSource="service_charge_wd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridservice_charge_wd" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="824" fieldSourceType="DBColumn" dataType="Text" html="False" name="clerk_qty" fieldSource="clerk_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridclerk_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="825" fieldSourceType="DBColumn" dataType="Text" html="False" name="booking_hour" fieldSource="booking_hour" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridbooking_hour">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="826" fieldSourceType="DBColumn" dataType="Text" html="False" name="f_and_b" fieldSource="f_and_b" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridf_and_b">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="827" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="836" fieldSourceType="DBColumn" dataType="Text" html="False" name="seat_qty" fieldSource="seat_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridseat_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="837" fieldSourceType="DBColumn" dataType="Text" html="False" name="portion_person" fieldSource="portion_person" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridportion_person">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="823" fieldSourceType="DBColumn" dataType="Text" html="False" name="room_qty" fieldSource="room_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridroom_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="935" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge_we" fieldSource="service_charge_we" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridservice_charge_we" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1029" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="v_vat_reg_dtl_entertaintmentGridvalid_from" fieldSource="valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1038" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="v_vat_reg_dtl_entertaintmentGridvalid_to" fieldSource="valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="830" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="831" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="965" conditionType="Parameter" useIsNull="False" field="t_cust_account_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_account_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="964" tableName="t_cacc_dtl_entertaintment" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="838" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_parkingGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="t_acc_dtl_parking">
			<Components>
				<Label id="839" fieldSourceType="DBColumn" dataType="Text" html="False" name="classification_desc" fieldSource="classification_desc" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridclassification_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="840" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="841" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_acc_dtl_parking_id" fieldSource="t_acc_dtl_parking_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridt_acc_dtl_parking_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="842" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_parkingGridDLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_acc_dtl_parking_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="972" sourceType="DataField" name="t_acc_dtl_parking_id" source="t_acc_dtl_parking_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="844" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_parkingGridADLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_acc_dtl_parking_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="973" sourceType="DataField" name="t_acc_dtl_parking_id" source="t_acc_dtl_parking_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="846" fieldSourceType="DBColumn" dataType="Float" html="False" name="parking_size" fieldSource="parking_size" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridparking_size" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="847" fieldSourceType="DBColumn" dataType="Text" html="False" name="max_load_qty" fieldSource="max_load_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridmax_load_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="851" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="895" fieldSourceType="DBColumn" dataType="Text" html="False" name="avg_subscription_qty" fieldSource="avg_subscription_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridavg_subscription_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1030" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_parkingGridvalid_from" fieldSource="valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1039" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_parkingGridvalid_to" fieldSource="valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="856" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="857" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="971" conditionType="Parameter" useIsNull="False" field="t_cust_account_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_account_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="970" tableName="t_acc_dtl_parking" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="862" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_ppjGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="t_cacc_dtl_ppj">
			<Components>
				<Label id="863" fieldSourceType="DBColumn" dataType="Text" html="False" name="pwr_classification_desc" fieldSource="pwr_classification_desc" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridpwr_classification_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="864" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="865" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cacc_dtl_ppj_id" fieldSource="t_cacc_dtl_ppj_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridt_cacc_dtl_ppj_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="866" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_ppjGridDLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_ppj_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="977" sourceType="DataField" name="t_cacc_dtl_ppj_id" source="t_cacc_dtl_ppj_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="868" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_ppjGridADLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_ppj_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="978" sourceType="DataField" name="t_cacc_dtl_ppj_id" source="t_cacc_dtl_ppj_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="870" fieldSourceType="DBColumn" dataType="Float" html="False" name="power_capacity" fieldSource="power_capacity" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridpower_capacity" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="871" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_charge" fieldSource="service_charge" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridservice_charge">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="872" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="881" fieldSourceType="DBColumn" dataType="Text" html="False" name="power_factor" fieldSource="power_factor" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridpower_factor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="882" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1031" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_ppjGridvalid_from" fieldSource="valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1040" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_ppjGridvalid_to" fieldSource="valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="875" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="876" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="975" conditionType="Parameter" useIsNull="False" field="t_cust_account_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_account_id"/>
				<TableParameter id="976" conditionType="Parameter" useIsNull="False" field="is_pln" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="Y"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="974" tableName="t_cacc_dtl_ppj" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="896" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_ppj_nplGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT t_cacc_dtl_ppj_id AS t_cacc_dtl_ppj_pln_id, t_cust_account_id, is_pln, p_pwr_classification_id, pwr_classification_desc, power_capacity, power_factor,
service_charge, valid_from, valid_to, description, creation_date, created_by, updated_date, updated_by, owner_qty 
FROM t_cacc_dtl_ppj
WHERE t_cacc_dtl_ppj_id = {t_cacc_dtl_ppj_id}
AND is_pln = 'N' ">
			<Components>
				<Label id="897" fieldSourceType="DBColumn" dataType="Text" html="False" name="owner_qty" fieldSource="owner_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGridowner_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="898" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="899" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cacc_dtl_ppj_pln_id" fieldSource="t_cacc_dtl_ppj_pln_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGridt_cacc_dtl_ppj_pln_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="900" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_ppj_nplGridDLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_ppj_pln_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="998" sourceType="DataField" name="t_cacc_dtl_ppj_pln_id" source="t_cacc_dtl_ppj_pln_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="902" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_ppj_nplGridADLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_ppj_pln_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="999" sourceType="DataField" name="t_cacc_dtl_ppj_pln_id" source="t_cacc_dtl_ppj_pln_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="904" fieldSourceType="DBColumn" dataType="Float" html="False" name="power_capacity" fieldSource="power_capacity" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGridpower_capacity" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="905" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGridt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="907" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1032" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_ppj_nplGridvalid_from" fieldSource="valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1036" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_ppj_nplGridvalid_to" fieldSource="valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="910" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="911" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="980" conditionType="Parameter" useIsNull="False" field="t_cacc_dtl_ppj_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cacc_dtl_ppj_id"/>
				<TableParameter id="981" conditionType="Parameter" useIsNull="False" field="is_pln" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="is_pln"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="997" parameterType="URL" variable="t_cacc_dtl_ppj_id" dataType="Float" parameterSource="t_cacc_dtl_ppj_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="915" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_hotel_srvcGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="t_cacc_dtl_hotel_srvc">
			<Components>
				<Label id="916" fieldSourceType="DBColumn" dataType="Text" html="False" name="services" fieldSource="services" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotel_srvcGridservices">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="917" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="918" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cacc_dtl_hotel_srvc_id" fieldSource="t_cacc_dtl_hotel_srvc_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotel_srvcGridt_cacc_dtl_hotel_srvc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="919" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_hotel_srvcGridDLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_hotel_srvc_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="1003" sourceType="DataField" name="t_cacc_dtl_hotel_srvc_id" source="t_cacc_dtl_hotel_srvc_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="921" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_hotel_srvcGridADLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cacc_dtl_hotel_srvc_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="1002" sourceType="DataField" name="t_cacc_dtl_hotel_srvc_id" source="t_cacc_dtl_hotel_srvc_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="926" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotel_srvcGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="924" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotel_srvcGridt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="1033" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_hotel_srvcGridvalid_from" fieldSource="valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1037" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_hotel_srvcGridvalid_to" fieldSource="valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="929" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="930"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="1001" conditionType="Parameter" useIsNull="False" field="t_cust_account_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_account_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="1000" tableName="t_cacc_dtl_hotel_srvc" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_vat_setllementSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_vat_setllement_ro_otobuk.ccp" PathID="t_vat_setllementSearch" pasteActions="pasteActions">
			<Components>
				<Hidden id="1004" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_setllementSearcht_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="137" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" name="customer_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchcustomer_name" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="136" fieldSourceType="DBColumn" dataType="Float" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearcht_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="1005" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_employeeGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_cust_acc_employee">
			<Components>
				<Label id="1006" fieldSourceType="DBColumn" dataType="Text" html="False" name="jabatan" fieldSource="jabatan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridjabatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="1007" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="939" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_acc_employee_id" fieldSource="t_cust_acc_employee_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridt_cust_acc_employee_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="1008" fieldSourceType="DBColumn" dataType="Float" html="False" name="employee_qty" fieldSource="employee_qty" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridemployee_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1009" fieldSourceType="DBColumn" dataType="Float" html="False" name="employee_salery" fieldSource="employee_salery" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridemployee_salery" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="1011" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_employeeGridDLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cust_acc_employee_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="1012" sourceType="DataField" name="t_cust_acc_employee_id" source="t_cust_acc_employee_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="1013" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_employeeGridADLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_cust_acc_employee_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="1014" sourceType="DataField" name="t_cust_acc_employee_id" source="t_cust_acc_employee_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="1015" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_employeeGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="1016" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="1019" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_employeeGridvalid_from" fieldSource="valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="1020" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_employeeGridvalid_to" fieldSource="valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="1021" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="1022" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="1023" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="1024" conditionType="Parameter" useIsNull="False" field="t_cust_account_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_account_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="1025" tableName="v_cust_acc_employee" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="1026" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtlGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT * 
FROM v_cacc_license_letter
WHERE t_cust_account_id = {t_cust_account_id} ">
			<Components>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="license_type_code" fieldSource="license_type_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridlicense_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cacc_license_letter_id" fieldSource="t_cacc_license_letter_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridt_cacc_license_letter_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="509" fieldSourceType="DBColumn" dataType="Text" html="False" name="license_no" fieldSource="license_no" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridlicense_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="510" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridvalid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="542" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridvalid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="52" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtlGridDLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_license_letter_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="1041" sourceType="DataField" name="t_cacc_license_letter_id" source="t_cacc_license_letter_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="54" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtlGridADLink" hrefSource="data_potensi.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_license_letter_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="1042" sourceType="DataField" format="yyyy-mm-dd" name="t_cacc_license_letter_id" source="t_cacc_license_letter_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="332" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="781" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="763" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="129" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="1043" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="786" conditionType="Parameter" useIsNull="False" field="t_cust_account_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_account_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="1044" tableName="v_cacc_license_letter" posWidth="20" posHeight="40" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="457" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="1045" parameterType="URL" variable="t_cust_account_id" dataType="Float" parameterSource="t_cust_account_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="data_potensi_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="data_potensi.php" forShow="True" url="data_potensi.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="884"/>
			</Actions>
		</Event>
	</Events>
</Page>
