<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="40" connection="ConnSIKP" name="t_laporan_status_wp" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="select CASE WHEN cust_account.p_account_status_id = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END as status,count(*) as jumlah,
CASE
WHEN cust_account.p_account_status_id = 1 THEN
	'1'
ELSE
	'2'
END AS status_id from t_cust_account cust_account 
group by cust_account.p_account_status_id,
CASE
WHEN cust_account.p_account_status_id = 1 THEN
	'1'
ELSE
	'2'
END" parameterTypeListName="ParameterTypeList">
			<Components>
				<Link id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="status" fieldSource="status" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_laporan_status_wpstatus" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET">
<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters/>
</Link>
<Label id="71" fieldSourceType="DBColumn" dataType="Float" html="False" name="jumlah" fieldSource="jumlah" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_laporan_status_wpjumlah" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="80" fieldSourceType="DBColumn" dataType="Text" html="False" name="status_id" PathID="t_laporan_status_wpstatus_id" fieldSource="status_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="77"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="78"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="79" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_status_pelaporan_wp_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_status_pelaporan_wp.php" forShow="True" url="t_status_pelaporan_wp.php" comment="//" codePage="windows-1252"/>
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
