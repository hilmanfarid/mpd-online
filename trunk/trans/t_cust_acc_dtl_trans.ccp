<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_cust_acc_dtl_transGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="select t_cust_acc_dtl_trans_id, t_cust_account_id, bill_no, service_desc, service_charge, vat_charge, description
from f_get_cust_acc_dtl_trans({t_cust_account_id},'{trans_date}')AS tbl (t_cust_acc_dtl_trans_id)" parameterTypeListName="ParameterTypeList">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_cust_acc_dtl_trans.ccp" removeParameters="t_cust_acc_dtl_trans;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_cust_acc_dtl_trans.ccp" wizardThemeItem="GridA" PathID="t_cust_acc_dtl_transGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="247" sourceType="DataField" name="t_cust_acc_dtl_trans_id" source="t_cust_acc_dtl_trans_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="19" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge" fieldSource="service_charge" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_dtl_transGridservice_charge" format="0">
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
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="bill_no" fieldSource="bill_no" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_dtl_transGridbill_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_acc_dtl_trans_id" fieldSource="t_cust_acc_dtl_trans_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_cust_acc_dtl_transGridt_cust_acc_dtl_trans_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="248" fieldSourceType="DBColumn" dataType="Float" html="False" name="vat_charge" fieldSource="vat_charge" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_dtl_transGridvat_charge" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_dtl_transGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="249" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_desc" fieldSource="service_desc" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_dtl_transGridservice_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="250" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardCaption="P App Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transGridt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="226"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="227"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="243" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="251" variable="t_cust_account_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_cust_account_id"/>
				<SQLParameter id="252" variable="trans_date" parameterType="URL" dataType="Text" parameterSource="trans_date"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_cust_acc_dtl_transForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_cust_acc_dtl_transForm" customDeleteType="SQL" activeCollection="ISQLParameters" customUpdateType="SQL" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="select o_result_code, o_result_msg from 
f_ins_cust_acc_dtl_trans({t_cust_account_id},
                         '{trans_date}',
                         '{bill_no}',
                         null,
                         {service_charge},
                         null,
                         '{description}',
                         '{UserName}')" customInsertType="SQL" customUpdate="UPDATE t_cust_acc_dtl_trans SET
service_desc = '{service_desc}',
description = '{description}',
bill_no = '{bill_no}',
service_charge = {service_charge},
vat_charge = {vat_charge},
updated_date = sysdate,
updated_by = '{UserName}'
WHERE t_cust_acc_dtl_trans_id = {t_cust_acc_dtl_trans_id}" customDelete="DELETE FROM t_cust_acc_dtl_trans
WHERE  t_cust_acc_dtl_trans_id = {t_cust_acc_dtl_trans_id}" dataSource="SELECT t_cust_acc_dtl_trans_id, t_cust_account_id, to_char(trans_date,'YYYY-MM-DD')as trans_date, bill_no, p_entertaintment_type_id, p_hotel_grade_id, p_room_type_id,
p_parking_classification_id, updated_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, created_by, to_char(creation_date,'DD-MON-YYYY')as creation_date, description, portion_person, f_and_b,
booking_hour, clerk_qty, room_qty, seat_qty, vat_charge, service_charge, service_desc, p_rest_service_type_id, power_capacity,
p_pwr_classification_id 
FROM t_cust_acc_dtl_trans
WHERE t_cust_acc_dtl_trans_id = {t_cust_acc_dtl_trans_id} ">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_cust_acc_dtl_transFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_cust_acc_dtl_transFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_cust_acc_dtl_transFormButton_Delete" removeParameters="FLAG;t_cust_acc_dtl_trans_id;t_cust_acc_dtl_transGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_cust_acc_dtl_transFormButton_Cancel" removeParameters="FLAG;t_cust_acc_dtl_trans_id;t_cust_acc_dtl_transGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="t_cust_acc_dtl_trans_id" fieldSource="t_cust_acc_dtl_trans_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormt_cust_acc_dtl_trans_id" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="bill_no" fieldSource="bill_no" required="True" caption="No Faktur" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormbill_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="123" fieldSourceType="DBColumn" dataType="Text" name="t_cust_acc_dtl_transGridPage" PathID="t_cust_acc_dtl_transFormt_cust_acc_dtl_transGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="196" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="service_charge" fieldSource="service_charge" required="True" caption="Nilai Transaksi" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormservice_charge" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="254" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardCaption="P App Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="255" fieldSourceType="DBColumn" dataType="Text" name="trans_date" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormtrans_date" defaultValue="date(&quot;Y-m-d&quot;)" format="yyyy-mm-dd" fieldSource="trans_date" caption="Tgl. Transaksi">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="200" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="vat_charge" fieldSource="vat_charge" required="False" caption="Nila Pajak" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormvat_charge" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="253" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="service_desc" fieldSource="service_desc" required="False" caption="Nama Faktur" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transFormservice_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="317" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_cust_acc_dtl_transFormButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="256"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="246" conditionType="Parameter" useIsNull="False" field="t_cust_acc_dtl_trans_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_acc_dtl_trans_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="343" parameterType="URL" variable="t_cust_acc_dtl_trans_id" dataType="Float" parameterSource="t_cust_acc_dtl_trans_id"/>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="245" tableName="t_cust_acc_dtl_trans" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="318" tableName="t_cust_acc_dtl_trans" fieldName="t_cust_acc_dtl_trans_id"/>
				<Field id="319" tableName="t_cust_acc_dtl_trans" fieldName="t_cust_account_id"/>
				<Field id="320" tableName="t_cust_acc_dtl_trans" fieldName="trans_date"/>
				<Field id="321" tableName="t_cust_acc_dtl_trans" fieldName="bill_no"/>
				<Field id="322" tableName="t_cust_acc_dtl_trans" fieldName="p_entertaintment_type_id"/>
				<Field id="323" tableName="t_cust_acc_dtl_trans" fieldName="p_hotel_grade_id"/>
				<Field id="324" tableName="t_cust_acc_dtl_trans" fieldName="p_room_type_id"/>
				<Field id="325" tableName="t_cust_acc_dtl_trans" fieldName="p_parking_classification_id"/>
				<Field id="326" tableName="t_cust_acc_dtl_trans" fieldName="updated_by"/>
				<Field id="327" tableName="t_cust_acc_dtl_trans" fieldName="updated_date"/>
				<Field id="328" tableName="t_cust_acc_dtl_trans" fieldName="created_by"/>
				<Field id="329" tableName="t_cust_acc_dtl_trans" fieldName="creation_date"/>
				<Field id="330" tableName="t_cust_acc_dtl_trans" fieldName="description"/>
				<Field id="331" tableName="t_cust_acc_dtl_trans" fieldName="portion_person"/>
				<Field id="332" tableName="t_cust_acc_dtl_trans" fieldName="f_and_b"/>
				<Field id="333" tableName="t_cust_acc_dtl_trans" fieldName="booking_hour"/>
				<Field id="334" tableName="t_cust_acc_dtl_trans" fieldName="clerk_qty"/>
				<Field id="335" tableName="t_cust_acc_dtl_trans" fieldName="room_qty"/>
				<Field id="336" tableName="t_cust_acc_dtl_trans" fieldName="seat_qty"/>
				<Field id="337" tableName="t_cust_acc_dtl_trans" fieldName="vat_charge"/>
				<Field id="338" tableName="t_cust_acc_dtl_trans" fieldName="service_charge"/>
				<Field id="339" tableName="t_cust_acc_dtl_trans" fieldName="service_desc"/>
				<Field id="340" tableName="t_cust_acc_dtl_trans" fieldName="p_rest_service_type_id"/>
				<Field id="341" tableName="t_cust_acc_dtl_trans" fieldName="power_capacity"/>
				<Field id="342" tableName="t_cust_acc_dtl_trans" fieldName="p_pwr_classification_id"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="257" variable="service_desc" parameterType="Control" dataType="Text" parameterSource="service_desc"/>
				<SQLParameter id="258" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="259" variable="t_cust_account_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_account_id"/>
				<SQLParameter id="260" variable="bill_no" parameterType="Control" dataType="Text" parameterSource="bill_no"/>
				<SQLParameter id="261" variable="service_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="service_charge"/>
				<SQLParameter id="262" variable="vat_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="vat_charge"/>
				<SQLParameter id="263" variable="UserName" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="271" variable="trans_date" parameterType="Control" dataType="Text" parameterSource="trans_date"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="228" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="229" field="vat_code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="230" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="231" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="232" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="233" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="234" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="264" variable="service_desc" parameterType="Control" dataType="Text" parameterSource="service_desc"/>
				<SQLParameter id="265" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="266" variable="bill_no" parameterType="Control" dataType="Text" parameterSource="bill_no"/>
				<SQLParameter id="267" variable="service_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="service_charge"/>
				<SQLParameter id="268" variable="vat_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="vat_charge"/>
				<SQLParameter id="269" variable="UserName" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="270" variable="t_cust_acc_dtl_trans_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_acc_dtl_trans_id"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="236" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="237" field="vat_code" dataType="Text" parameterType="Control" parameterSource="vat_code"/>
				<CustomParameter id="238" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="239" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="240" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="241" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="242" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="218" variable="t_cust_acc_dtl_trans_id" parameterType="Control" dataType="Float" parameterSource="t_cust_acc_dtl_trans_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_cust_acc_dtl_transSearch" wizardCaption="Search P App Module Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_cust_acc_dtl_trans.ccp" PathID="t_cust_acc_dtl_transSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="190" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="trans_date" caption="Tgl. Transaksi" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transSearchtrans_date" defaultValue="date(&quot;Y-m-d&quot;)" format="yyyy-mm-dd" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="191" name="DatePicker_trans_date" control="trans_date" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_cust_acc_dtl_transSearchDatePicker_trans_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwd" wizardCaption="Keyword" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="t_cust_acc_dtl_transSearchnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_cust_acc_dtl_transSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="192" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardCaption="P App Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transSearcht_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="217" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
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
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="uploadForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="uploadForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" returnPage="t_cust_acc_dtl_trans.ccp">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_xl" wizardCaption="Add" PathID="uploadFormButton_xl" removeParameters="FLAG">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="314"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="315" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardCaption="P App Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="uploadFormt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="316" fieldSourceType="DBColumn" dataType="Text" name="trans_date" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="uploadFormtrans_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters>
				<SPParameter id="Key176" parameterName="i_p_app_user_id" parameterSource="0" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key178" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key179" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key181" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key182" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key184" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key185" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key187" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key188" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="284" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="285" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="286" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="287" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="288" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="289" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="290" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="291" field="rqst_type_code" dataType="Text" parameterType="Control" parameterSource="rqst_type_code"/>
				<CustomParameter id="292" field="order_status_code" dataType="Text" parameterType="Control" parameterSource="order_status_code"/>
				<CustomParameter id="293" field="order_date" dataType="Text" parameterType="Control" parameterSource="order_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="294" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="295" field="p_order_status_id" dataType="Float" parameterType="Control" parameterSource="p_order_status_id"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key154" parameterName="i_flag" parameterSource="2" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key155" parameterName="i_p_app_user_id" parameterSource="p_app_user_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key156" parameterName="i_user_name" parameterSource="user_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key157" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key158" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key159" parameterName="i_p_user_type_id" parameterSource="p_user_type_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key160" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key161" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key162" parameterName="i_p_region_structure_id" parameterSource="p_region_structure_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key163" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key164" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key165" parameterName="i_expired_user" parameterSource="expired_user" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key166" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key167" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="302" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="303" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="304" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="305" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="306" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="307" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="308" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="309" field="rqst_type_code" dataType="Text" parameterType="Control" parameterSource="rqst_type_code"/>
				<CustomParameter id="310" field="order_status_code" dataType="Text" parameterType="Control" parameterSource="order_status_code"/>
				<CustomParameter id="311" field="order_date" dataType="Text" parameterType="Control" parameterSource="order_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="312" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="313" field="p_order_status_id" dataType="Float" parameterType="Control" parameterSource="p_order_status_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_cust_acc_dtl_trans_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_cust_acc_dtl_trans.php" forShow="True" url="t_cust_acc_dtl_trans.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="344"/>
			</Actions>
		</Event>
	</Events>
</Page>
