<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_cacc_legal_docGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT * 
FROM t_cust_acc_masa_jab 
WHERE nama LIKE '%{s_keyword}%'
AND t_cust_account_id = {t_cust_account_id} ">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_cacc_masa_jab.ccp" removeParameters="t_cust_acc_masa_jab_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="t_cacc_legal_docGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_cacc_masa_jab.ccp" wizardThemeItem="GridA" PathID="t_cacc_legal_docGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="696" sourceType="DataField" name="t_cust_acc_masa_jab_id" source="t_cust_acc_masa_jab_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="masa_akhir" fieldSource="masa_akhir" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cacc_legal_docGridmasa_akhir">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="nama" fieldSource="nama" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cacc_legal_docGridnama">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="699" fieldSourceType="DBColumn" dataType="Text" html="False" name="masa_awal" fieldSource="masa_awal" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cacc_legal_docGridmasa_awal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="724" fieldSourceType="DBColumn" dataType="Text" name="t_cust_acc_masa_jab_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cacc_legal_docGridt_cust_acc_masa_jab_id" fieldSource="t_cust_acc_masa_jab_id" caption="t_cust_acc_masa_jab_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="129"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="623" conditionType="Parameter" useIsNull="False" field="legal_doc_desc" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
				<TableParameter id="675" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="457" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="694" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
				<SQLParameter id="695" parameterType="URL" variable="t_cust_account_id" dataType="Float" parameterSource="t_cust_account_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_cacc_legal_docSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_cacc_masa_jab.ccp" PathID="t_cacc_legal_docSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="559" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_cacc_legal_docSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_cacc_legal_docSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="459" fieldSourceType="DBColumn" dataType="Text" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cacc_legal_docSearcht_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="697" fieldSourceType="DBColumn" dataType="Text" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cacc_legal_docSearcht_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="698" fieldSourceType="DBColumn" dataType="Text" name="customer_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cacc_legal_docSearchcustomer_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="745" fieldSourceType="DBColumn" dataType="Float" name="t_cust_acc_masa_jab_id" fieldSource="t_cust_acc_masa_jab_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cacc_legal_docSearcht_cust_acc_masa_jab_id">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_cacc_legal_docForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_cacc_legal_docForm" activeCollection="ISQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" dataSource="SELECT t_cust_acc_masa_jab_id, t_cust_account_id, nama, 
to_char(masa_awal, 'DD-MM-YYYY')as masa_awal, 
to_char(masa_akhir, 'DD-MM-YYYY')as masa_akhir,
to_char(creation_date, 'DD-MM-YYYY')as creation_date, 
created_by , to_char(updated_date,'DD-MM-YYYY')as updated_date, update_by 
FROM t_cust_acc_masa_jab
WHERE t_cust_acc_masa_jab_id = {t_cust_acc_masa_jab_id} " customInsert="select * from 
f_insert_t_cust_acc_masa_jab('{nama}', 
{t_cust_account_id}, '{created_by}', 
'{updated_by}','{masa_awal}', '{masa_akhir}')" removeParameters="add_flag;" customUpdate="UPDATE t_cust_acc_masa_jab 
SET update_by='{updated_by}', 
updated_date=sysdate, 
nama='{nama}', 
masa_awal='{masa_awal}', 
masa_akhir=case when '{masa_akhir}' = '' then null else to_date('{masa_akhir}') end
where 
t_cust_acc_masa_jab_id={t_cust_acc_masa_jab_id}" customDelete="DELETE FROM t_cust_acc_masa_jab
where 
t_cust_acc_masa_jab_id = {t_cust_acc_masa_jab_id}">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_cacc_legal_docFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_cacc_legal_docFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_cacc_legal_docFormButton_Delete" removeParameters="FLAG;s_keyword;t_cacc_legal_doc_id;t_cacc_legal_docGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="98" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_cacc_legal_docFormButton_Cancel" removeParameters="FLAG;s_keyword;t_cacc_legal_doc_id;t_cacc_legal_docGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="t_cust_acc_masa_jab_id" fieldSource="t_cust_acc_masa_jab_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cacc_legal_docFormt_cust_acc_masa_jab_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cacc_legal_docFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="update_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cacc_legal_docFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cacc_legal_docFormcreation_date" format="dd-mm-yyyy" defaultValue="date(&quot;d-m-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cacc_legal_docFormupdated_date" defaultValue="date(&quot;d-m-Y&quot;)" format="dd-mm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="t_cacc_legal_docGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cacc_legal_docFormt_cacc_legal_docGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="700" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama" fieldSource="nama" required="True" caption="nama" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cacc_legal_docFormnama">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="701" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="masa_awal" PathID="t_cacc_legal_docFormmasa_awal" format="dd-mm-yyyy" required="True" fieldSource="masa_awal" caption="masa awal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="191" name="DatePicker_tgl_penerimaan" control="masa_awal" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_cacc_legal_docFormDatePicker_tgl_penerimaan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="702" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="masa_akhir" PathID="t_cacc_legal_docFormmasa_akhir" format="dd-mm-yyyy" fieldSource="masa_akhir" caption="masa akhir">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="704" name="DatePicker_tgl_penerimaan1" control="masa_akhir" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_cacc_legal_docFormDatePicker_tgl_penerimaan1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="723" fieldSourceType="DBColumn" dataType="Text" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cacc_legal_docFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="626" conditionType="Parameter" useIsNull="False" field="t_cust_order_legal_doc_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_order_legal_doc_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="692" parameterType="URL" variable="t_cust_acc_masa_jab_id" dataType="Float" parameterSource="t_cust_acc_masa_jab_id" defaultValue="0"/>
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
				<SQLParameter id="639" variable="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<SQLParameter id="640" variable="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<SQLParameter id="645" variable="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id" defaultValue="0"/>
				<SQLParameter id="709" variable="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="710" variable="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="715" variable="t_cust_acc_masa_jab_id" dataType="Float" parameterType="Control" parameterSource="t_cust_acc_masa_jab_id" defaultValue="0"/>
				<SQLParameter id="716" variable="nama" dataType="Text" parameterType="Control" parameterSource="nama"/>
				<SQLParameter id="717" variable="masa_awal" dataType="Text" parameterType="Control" parameterSource="masa_awal" format="dd-mm-yyyy"/>
				<SQLParameter id="718" variable="masa_akhir" dataType="Text" parameterType="Control" parameterSource="masa_akhir" format="dd-mm-yyyy"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="629" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
				<CustomParameter id="630" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
				<CustomParameter id="631" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="632" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="705" field="t_cacc_masa_jab_id" dataType="Float" parameterType="Control" parameterSource="t_cacc_masa_jab_id" omitIfEmpty="True"/>
				<CustomParameter id="707" field="masa_awal" dataType="Date" parameterType="Control" parameterSource="masa_awal" format="dd-mm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="708" field="masa_akhir" dataType="Date" parameterType="Control" parameterSource="masa_akhir" format="dd-mm-yyyy" omitIfEmpty="True"/>
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
				<SQLParameter id="666" variable="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<SQLParameter id="734" variable="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="741" variable="t_cust_acc_masa_jab_id" dataType="Float" parameterType="Control" parameterSource="t_cust_acc_masa_jab_id"/>
				<SQLParameter id="742" variable="nama" dataType="Text" parameterType="Control" parameterSource="nama"/>
				<SQLParameter id="743" variable="masa_awal" dataType="Text" parameterType="Control" parameterSource="masa_awal" format="dd-mm-yyyy"/>
				<SQLParameter id="744" variable="masa_akhir" dataType="Text" parameterType="Control" parameterSource="masa_akhir" format="dd-mm-yyyy"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="651" field="t_cust_order_legal_doc_id" dataType="Float" parameterType="Control" parameterSource="t_cust_order_legal_doc_id"/>
				<CustomParameter id="652" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="653" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="654" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="655" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="656" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="657" field="legal_doc_desc" dataType="Text" parameterType="Control" parameterSource="legal_doc_desc"/>
				<CustomParameter id="658" field="p_legal_doc_type_id" dataType="Float" parameterType="Control" parameterSource="p_legal_doc_type_id"/>
				<CustomParameter id="659" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="660" field="origin_file_name" dataType="Text" parameterType="Control" parameterSource="origin_file_name"/>
				<CustomParameter id="661" field="file_folder" dataType="Text" parameterType="Control" parameterSource="file_folder"/>
				<CustomParameter id="662" field="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<CustomParameter id="725" field="t_cust_acc_masa_jab_id" dataType="Float" parameterType="Control" parameterSource="t_cust_acc_masa_jab_id"/>
				<CustomParameter id="726" field="nama" dataType="Text" parameterType="Control" parameterSource="nama"/>
				<CustomParameter id="727" field="masa_awal" dataType="Text" parameterType="Control" parameterSource="masa_awal" format="dd-mm-yyyy"/>
				<CustomParameter id="728" field="masa_akhir" dataType="Text" parameterType="Control" parameterSource="masa_akhir" format="dd-mm-yyyy"/>
				<CustomParameter id="729" field="t_cust_account_id" dataType="Text" parameterType="Control" parameterSource="t_cust_account_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="674" variable="t_cust_acc_masa_jab_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_acc_masa_jab_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_cacc_masa_jab_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_cacc_masa_jab.php" forShow="True" url="t_cacc_masa_jab.php" comment="//" codePage="windows-1252"/>
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
	</Events>
</Page>
