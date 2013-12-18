<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_customerGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT a.t_customer_id, a.company_owner, a.p_job_position_id, 
a.address_name_owner, a.address_no_owner, a.address_rt_owner, a.address_rw_owner,
a.p_region_id_kel_owner, a.p_region_id_kec_owner, a.p_region_id_owner, a.phone_no_owner, a.mobile_no_owner,
a.fax_no_owner, a.zip_code_owner, a.email_address, a.creation_date, a.created_by, a.updated_date, a.updated_by,
b.code AS nama_jabatan,
c.region_name AS nama_kota,
d.region_name AS nama_kecamatan,
e.region_name AS nama_kelurahan,
(a.address_name_owner || '. NO ' || a.address_no_owner || '. ' || c.region_name || '. ' || d.region_name || '. ' || e.region_name || '. ' || 'RT ' || a.address_rt_owner || '/ RW ' || a.address_rw_owner ) AS alamat_lengkap

FROM t_customer a
LEFT JOIN  p_job_position b ON a.p_job_position_id = b.p_job_position_id
LEFT JOIN p_region c ON a.p_region_id_owner = c.p_region_id
LEFT JOIN p_region d ON a.p_region_id_kec_owner = d.p_region_id
LEFT JOIN p_region e ON a.p_region_id_kel_owner = e.p_region_id


WHERE upper(a.company_owner) like '%{s_keyword}%'

ORDER BY a.t_customer_id">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_customer_bck.ccp" wizardThemeItem="GridA" PathID="t_customerGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="458" sourceType="DataField" name="t_customer_id" source="t_customer_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="company_owner" fieldSource="company_owner" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridcompany_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="alamat_lengkap" fieldSource="alamat_lengkap" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridalamat_lengkap">
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
				<Label id="318" fieldSourceType="DBColumn" dataType="Text" html="False" name="email_address" fieldSource="email_address" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridemail_address">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="459" fieldSourceType="DBColumn" dataType="Text" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerGridt_customer_id" fieldSource="t_customer_id">
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
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="457" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="335" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_customerSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_customer_bck.ccp" PathID="t_customerSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_customerSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_customerSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_customerForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_customerForm" activeCollection="SQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="SELECT a.t_customer_id, a.company_owner, a.p_job_position_id, 
a.address_name_owner, a.address_no_owner, a.address_rt_owner, a.address_rw_owner,
a.p_region_id_kel_owner, a.p_region_id_kec_owner, a.p_region_id_owner, a.phone_no_owner, a.mobile_no_owner,
a.fax_no_owner, a.zip_code_owner, a.email_address, a.creation_date, a.created_by, a.updated_date, a.updated_by,
b.code AS nama_jabatan,
c.region_name AS nama_kota,
d.region_name AS nama_kecamatan,
e.region_name AS nama_kelurahan,
(a.address_name_owner || '. NO ' || a.address_no_owner || '. ' || c.region_name || '. ' || d.region_name || '. ' || e.region_name || '. ' || 'RT ' || a.address_rt_owner || '/ RW ' || a.address_rw_owner ) AS alamat_lengkap

FROM t_customer a
LEFT JOIN  p_job_position b ON a.p_job_position_id = b.p_job_position_id
LEFT JOIN p_region c ON a.p_region_id_owner = c.p_region_id
LEFT JOIN p_region d ON a.p_region_id_kec_owner = d.p_region_id
LEFT JOIN p_region e ON a.p_region_id_kel_owner = e.p_region_id


WHERE a.t_customer_id = {t_customer_id}" activeTableType="customUpdate">
			<Components>
				<Label id="460" fieldSourceType="DBColumn" dataType="Text" html="False" name="nama_customer" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormnama_customer" fieldSource="company_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="461" fieldSourceType="DBColumn" dataType="Text" html="False" name="alamat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormalamat" fieldSource="address_name_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="462" fieldSourceType="DBColumn" dataType="Text" html="False" name="address_no_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormaddress_no_owner" fieldSource="address_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="463" fieldSourceType="DBColumn" dataType="Text" html="False" name="nama_kota" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormnama_kota" fieldSource="nama_kota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="464" fieldSourceType="DBColumn" dataType="Text" html="False" name="nama_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormnama_kecamatan" fieldSource="nama_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="465" fieldSourceType="DBColumn" dataType="Text" html="False" name="nama_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormnama_kelurahan" fieldSource="nama_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="466" fieldSourceType="DBColumn" dataType="Text" html="False" name="address_rt_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormaddress_rt_owner" fieldSource="address_rt_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="467" fieldSourceType="DBColumn" dataType="Text" html="False" name="zip_code_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormzip_code_owner" fieldSource="zip_code_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="468" fieldSourceType="DBColumn" dataType="Text" html="False" name="phone_no_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormphone_no_owner" fieldSource="phone_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="469" fieldSourceType="DBColumn" dataType="Text" html="False" name="fax_no_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormfax_no_owner" fieldSource="fax_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="470" fieldSourceType="DBColumn" dataType="Text" html="False" name="nama_jabatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormnama_jabatan" fieldSource="nama_jabatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="471" fieldSourceType="DBColumn" dataType="Text" html="False" name="mobile_no_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormmobile_no_owner" fieldSource="mobile_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="472" fieldSourceType="DBColumn" dataType="Text" html="False" name="email_address" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormemail_address" fieldSource="email_address">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="473" fieldSourceType="DBColumn" dataType="Text" html="False" name="address_rw_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormaddress_rw_owner" fieldSource="address_rw_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="474" fieldSourceType="DBColumn" dataType="Text" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormt_customer_id" fieldSource="t_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="475" fieldSourceType="DBColumn" dataType="Text" name="company_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerFormcompany_owner" fieldSource="company_owner">
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
				<SQLParameter id="289" variable="t_customer_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="t_customer_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="288" fieldName="*"/>
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
				<SQLParameter id="425" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="426" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="427" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="430" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="431" variable="is_head" dataType="Text" parameterType="Control" parameterSource="is_head"/>
				<SQLParameter id="432" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from"/>
				<SQLParameter id="433" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
				<SQLParameter id="434" variable="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id" defaultValue="0"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="413" field="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id"/>
				<CustomParameter id="414" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="415" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="416" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="417" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="418" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="419" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="420" field="is_head" dataType="Text" parameterType="Control" parameterSource="is_head"/>
				<CustomParameter id="421" field="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="422" field="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<CustomParameter id="423" field="parent_id" dataType="Text" parameterType="Control" parameterSource="parent_id"/>
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
				<SQLParameter id="447" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="449" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="452" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="453" variable="is_head" dataType="Text" parameterType="Control" parameterSource="is_head"/>
				<SQLParameter id="454" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<SQLParameter id="455" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<SQLParameter id="456" variable="p_job_position_id" parameterType="Control" dataType="Float" parameterSource="p_job_position_id" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="446" conditionType="Parameter" useIsNull="False" field="p_job_position_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_job_position_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="436" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="437" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="438" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="439" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="440" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="441" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="442" field="is_head" dataType="Text" parameterType="Control" parameterSource="is_head"/>
				<CustomParameter id="443" field="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="444" field="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="412" variable="p_job_position_id" parameterType="Control" dataType="Float" parameterSource="p_job_position_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_customer_bck_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="t_customer_bck.php" forShow="True" url="t_customer_bck.php" comment="//" codePage="windows-1252"/>
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
