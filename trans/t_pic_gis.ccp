<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_pic_gisSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_pic_gis.ccp" PathID="t_pic_gisSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="559" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_pic_gisSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_pic_gisSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="683" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_pic_gisSearchButton1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="684" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_pic_gisSearchButton2">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
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
		<Grid id="656" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_custAccountGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT a.t_cust_account_id, a.t_customer_id, a.npwd, a.p_vat_type_id, a.t_vat_registration_id, a.t_customer_order_id,
a.registration_date, a.company_name, a.company_brand, a.address_name, a.address_no, a.address_rt, a.address_rw, a.p_region_id_kelurahan, a.p_region_id_kecamatan, a.p_region_id, a.phone_no, a.mobile_no, a.fax_no, a.zip_code, a.creation_date, a.created_by, a.updated_date, a.updated_by,
b.vat_code,
c.registration_date AS vat_registration_date,
d.order_no, d. order_date,
e.region_name AS nama_kota,
f.region_name AS nama_kecamatan,
g.region_name AS nama_kelurahan

FROM t_cust_account a
LEFT JOIN p_vat_type b ON a.p_vat_type_id = b.p_vat_type_id
LEFT JOIN t_vat_registration c ON a.t_vat_registration_id = c.t_vat_registration_id
LEFT JOIN t_customer_order d ON a.t_customer_order_id = d.t_customer_order_id
LEFT JOIN p_region e ON a.p_region_id = e.p_region_id
LEFT JOIN p_region f ON a.p_region_id_kecamatan = f.p_region_id
LEFT JOIN p_region g ON a.p_region_id_kelurahan = g.p_region_id


WHERE (upper(a.company_name) ILIKE '%{s_keyword}%' OR upper(a.npwd) ILIKE '%{s_keyword}%')

ORDER BY a.t_cust_account_id">
			<Components>
				<Link id="657" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_pic_gis.ccp" wizardThemeItem="GridA" PathID="t_custAccountGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="479" sourceType="DataField" name="t_cust_account_id" source="t_cust_account_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="658" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwd" fieldSource="npwd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_custAccountGridnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="registration_date" fieldSource="registration_date" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_custAccountGridregistration_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="659" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="459" fieldSourceType="DBColumn" dataType="Text" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_custAccountGridt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="318" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_custAccountGridvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="660" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="661"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="662" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="335" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
				<SQLParameter id="476" variable="t_customer_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="t_customer_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_pic_gisGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select t_pic_gis.pic_id as pic_id,
							t_pic_gis.file_name as file_name, 
							t_pic_gis.longitude as &quot;Longitude&quot;, 
							t_pic_gis.latitude as &quot;Latitude&quot;, 
							t_pic_gis.creation_date as &quot;Uploaded&quot;, 
							t_pic_gis.updated_by as &quot;Uploader&quot;,
							t_pic_gis.id_tipe_lokasi as &quot;Tipe&quot;,
							lokasi.ikon_file as &quot;Ikon&quot;,
							t_pic_gis.&quot;NPWPD&quot; as &quot;NPWPD&quot;,
							t_cust_acc.wp_name as &quot;Name&quot;,
							t_cust_acc.wp_address_name as &quot;Alamat&quot;,
							t_pic_gis.status as &quot;Editable&quot;
							
FROM sikp.tb_pic_gis t_pic_gis
						  left join sikp.tipe_lokasi as lokasi on lokasi.id_tipe_lokasi = t_pic_gis.id_tipe_lokasi
						  left join sikp.t_cust_account as t_cust_acc on t_cust_acc.npwd = t_pic_gis.&quot;NPWPD&quot;
where t_cust_acc.t_cust_account_id = {t_cust_account_id}
order by pic_id ASC">
			<Components>
				<Link id="663" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_pic_gis.ccp" removeParameters="pic_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="t_pic_gisGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="664" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="665" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_pic_gis.ccp" wizardThemeItem="GridA" PathID="t_pic_gisGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="666" sourceType="DataField" name="pic_id" source="pic_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="667" fieldSourceType="DBColumn" dataType="Text" html="False" name="file_name" fieldSource="file_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_pic_gisGridfile_name" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
					</LinkParameters>
				</Label>
				<Navigator id="668" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="669" fieldSourceType="DBColumn" dataType="Float" html="False" name="pic_id" fieldSource="pic_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_pic_gisGridpic_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="670" fieldSourceType="DBColumn" dataType="Text" html="False" name="Alamat" fieldSource="Alamat" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_pic_gisGridAlamat">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="622" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="129" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="553" conditionType="Parameter" useIsNull="False" field="upper(order_no)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword" leftBrackets="1"/>
				<TableParameter id="558" conditionType="Parameter" useIsNull="False" field="upper(order_status_code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="457" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="627" parameterType="URL" variable="t_cust_account_id" dataType="Float" parameterSource="t_cust_account_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_pic_gisForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_pic_gisForm" activeCollection="UConditions" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="Table" customInsertType="SQL" dataSource="select t_pic_gis.pic_id as pic_id,
							t_pic_gis.file_name as file_name, 
							t_pic_gis.longitude as longitude, 
							t_pic_gis.latitude as latitude, 
							t_pic_gis.creation_date as &quot;Uploaded&quot;, 
							t_pic_gis.updated_by as &quot;Uploader&quot;,
							t_pic_gis.id_tipe_lokasi as &quot;Tipe&quot;,
							lokasi.ikon_file as &quot;Ikon&quot;,
							t_pic_gis.&quot;NPWPD&quot; as &quot;NPWPD&quot;,
							t_cust_acc.wp_name as &quot;Name&quot;,
							t_cust_acc.wp_address_name as &quot;Alamat&quot;,
							t_pic_gis.status as &quot;Editable&quot;,
							t_pic_gis.created_by,
							t_pic_gis.creation_date,
							t_pic_gis.updated_by,
							t_pic_gis.updated_date
							
FROM sikp.tb_pic_gis t_pic_gis
						  left join sikp.tipe_lokasi as lokasi on lokasi.id_tipe_lokasi = t_pic_gis.id_tipe_lokasi
						  left join sikp.t_cust_account as t_cust_acc on t_cust_acc.npwd = t_pic_gis.&quot;NPWPD&quot;
						  where pic_id = {pic_id}" customDelete="DELETE FROM t_customer_order
WHERE t_customer_order_id = {t_customer_order_id}" removeParameters="pic_id" customInsert="INSERT INTO tb_pic_gis(&quot;NPWPD&quot;,created_by, updated_by, creation_date, updated_date, latitude, longitude, file_name) VALUES((select npwd from t_cust_account where t_cust_account_id = {t_cust_account_id}),'{created_by}', '{updated_by}', '{creation_date}', '{updated_date}', {latitude}, {longitude}, '{file_name}')" customUpdate="tb_pic_gis" activeTableType="customUpdate">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_pic_gisFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_pic_gisFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_pic_gisFormButton_Delete" removeParameters="FLAG;t_customer_order_id;s_order_no;s_rqst_type;s_order_status;t_customer_orderGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="98" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_pic_gisFormButton_Cancel" removeParameters="FLAG;t_customer_order_id;s_order_no;s_rqst_type;s_order_status;t_customer_orderGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="pic_id" fieldSource="pic_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_pic_gisFormpic_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="latitude" fieldSource="latitude" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_pic_gisFormlatitude">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_pic_gisFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_pic_gisFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_pic_gisFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_pic_gisFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="639" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="longitude" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_pic_gisFormlongitude" fieldSource="longitude">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<FileUpload id="640" fieldSourceType="DBColumn" allowedFileMasks="*" fileSizeLimit="10000000" dataType="Text" tempFileFolder="../files_tmp" name="file_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_pic_gisFormfile_name" processedFileFolder="../files/img_gis" fieldSource="file_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Hidden id="671" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_pic_gisFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="OnSubmit" type="Client">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="634" eventType="Client"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="672"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="673"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="675"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="563" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="638" parameterType="URL" variable="pic_id" dataType="Float" parameterSource="pic_id" defaultValue="0"/>
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
				<SQLParameter id="583" variable="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<SQLParameter id="584" variable="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<SQLParameter id="645" variable="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="646" variable="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="647" variable="pic_id" dataType="Float" parameterType="Control" parameterSource="pic_id"/>
				<SQLParameter id="648" variable="latitude" dataType="Float" parameterType="Control" parameterSource="latitude"/>
				<SQLParameter id="649" variable="longitude" dataType="Float" parameterType="Control" parameterSource="longitude"/>
				<SQLParameter id="650" variable="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<SQLParameter id="674" variable="t_cust_account_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_account_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="571" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
				<CustomParameter id="572" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
				<CustomParameter id="573" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="574" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="641" field="pic_id" dataType="Float" parameterType="Control" parameterSource="pic_id" omitIfEmpty="True"/>
				<CustomParameter id="642" field="latitude" dataType="Float" parameterType="Control" parameterSource="latitude" omitIfEmpty="True"/>
				<CustomParameter id="643" field="longitude" dataType="Float" parameterType="Control" parameterSource="longitude" omitIfEmpty="True"/>
				<CustomParameter id="644" field="file_name" dataType="Text" parameterType="Control" parameterSource="file_name" omitIfEmpty="True"/>
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
				<SQLParameter id="605" variable="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<SQLParameter id="606" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="608" variable="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<SQLParameter id="611" variable="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<SQLParameter id="615" variable="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<SQLParameter id="616" variable="p_order_status_id" dataType="Float" parameterType="Expression" parameterSource="1" defaultValue="0"/>
				<SQLParameter id="676" variable="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<SQLParameter id="677" variable="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="678" variable="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="679" variable="latitude" dataType="Float" parameterType="Control" parameterSource="latitude"/>
				<SQLParameter id="680" variable="longitude" dataType="Float" parameterType="Control" parameterSource="longitude"/>
				<SQLParameter id="681" variable="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<SQLParameter id="682" variable="pic_id" parameterType="URL" dataType="Float" parameterSource="pic_id" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="655" conditionType="Parameter" useIsNull="False" field="pic_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="pic_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="595" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
				<CustomParameter id="596" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
				<CustomParameter id="597" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="598" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="652" field="latitude" dataType="Float" parameterType="Control" parameterSource="latitude" omitIfEmpty="True"/>
				<CustomParameter id="653" field="longitude" dataType="Float" parameterType="Control" parameterSource="longitude" omitIfEmpty="True"/>
				<CustomParameter id="654" field="file_name" dataType="Text" parameterType="Control" parameterSource="file_name" omitIfEmpty="True"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="617" variable="t_customer_order_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_customer_order_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_pic_gis_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_pic_gis.php" forShow="True" url="t_pic_gis.php" comment="//" codePage="windows-1252"/>
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
